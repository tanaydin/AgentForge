# 0002 - Django + PostgreSQL production stack

- **Status**: accepted
- **Date**: 2026-09-10
- **Builds on**: ADR 0001 (which deferred all technology choices). This ADR makes them.

## Context
ADR 0001 kept the repository dependency-free while the stack was undecided. The first
vertical slice needs the services a real web application requires from day one: a
production-grade relational database, background processing, a message broker, caching,
an API layer, and observability. There is no interim SQLite phase — the project targets
PostgreSQL from the start so that development, CI, and production run the same engine.

## Decision

| Concern | Choice |
|---|---|
| Language | Python 3.12+ |
| Web framework | Django 6.1 (`>=6.1,<6.2`) |
| Database | **PostgreSQL 16**, `psycopg[binary]` 3 — used in dev, CI, and prod |
| API | Django REST Framework + `django-filter` |
| Background tasks | **Celery 5** |
| Message broker | **RabbitMQ 3.13** (`amqp://`) |
| Task results | `django-celery-results` (DB) by default; Redis optional |
| Periodic tasks | `django-celery-beat` (DB-backed schedule) |
| Task monitoring | Flower |
| Cache & sessions | **Redis 7** via `django-redis` |
| Config | `django-environ` (12-factor; `.env` locally, env vars in prod) |
| Static files | WhiteNoise (`CompressedManifestStaticFilesStorage`) |
| App server | Gunicorn (WSGI); Uvicorn available for ASGI |
| Error tracking | Sentry (`sentry-sdk`), enabled only when `SENTRY_DSN` is set |
| Metrics | `django-prometheus` (`/metrics`) |
| Health checks | `django-health-check` (`/health/`) |
| Structured logging | `structlog` |
| CORS | `django-cors-headers` |
| Local orchestration | Docker Compose (`db`, `rabbitmq`, `redis`, `web`, `worker`, `beat`, `flower`) |
| Lint / format / types | ruff, black, mypy + django-stubs |
| Tests | pytest + pytest-django (against a PostgreSQL test database) |
| Pre-commit | ruff, django check, hygiene hooks |

## Layer mapping
- `src/config/` — Django project: `settings.py`, `urls.py`, `celery.py`, `wsgi.py`, `asgi.py`.
- `src/api/` — DRF views/serializers/routers (thin delivery).
- `src/infrastructure/` — ORM models + migrations, repository implementations, external
  clients, **Celery task wrappers** (`tasks.py`, thin — they call `src/application`).
- `src/application/`, `src/domain/` — plain Python, **no `django`, no `celery`** imports.

## Migrations
Migrations live in `src/infrastructure/migrations/`. The package starts empty (only
`__init__.py`); the first `makemigrations infrastructure` produces `0001_initial.py`.
All migrations are committed and run in every environment against PostgreSQL.

## Consequences
- Running the app requires PostgreSQL, RabbitMQ, and Redis. `docker compose up` provides
  all of them for local development; CI uses service containers.
- More runtime dependencies to keep patched; each is pinned with a loose upper bound and
  bumped deliberately via a follow-up ADR.
- Celery adds a second deployable (worker) plus optionally `beat` and `flower`.
- Task code stays thin; long/blocking work goes to Celery, not request handlers.
- Secrets (`SECRET_KEY`, `DATABASE_URL`, broker credentials, `SENTRY_DSN`) come from the
  environment only.
- Tests run against PostgreSQL — no SQLite compatibility shims to maintain.
- Moving the broker to Redis, or adding Kafka / websockets (Channels), would each be a
  new ADR.
