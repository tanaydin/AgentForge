# Project

Stack: **Python 3.12+ / Django 6.1 / PostgreSQL 16 / Celery 5 (RabbitMQ broker, Redis
results) / Redis cache / Django REST Framework**. See
`docs/architecture/decisions/` (ADR 0001–0002).

The repository keeps a layered architecture on top of Django: the domain and application
layers are plain Python and never import `django` or `celery`.

## Quick start

```
python -m venv .venv && source .venv/bin/activate
pip install -r requirements-dev.txt
pre-commit install
cp .env.example .env                 # set SECRET_KEY
docker compose up --build            # db + rabbitmq + redis + web + worker + beat + flower
#   web        http://localhost:8000/api/health/
#   flower     http://localhost:5555
#   rabbitmq   http://localhost:15672   (guest / guest)
#   metrics    http://localhost:8000/metrics
```

Without Docker (services running locally): `python manage.py migrate && python manage.py
runserver`, plus `celery -A src.config worker -l info`.

`DJANGO_SETTINGS_MODULE` is `src.config.settings`. Run commands from the repo root.

## Architecture

```
API (DRF)  ─┐
            ├─► Application (use cases) ─► Domain (rules) ─► Infrastructure (Postgres, Redis, clients)
Celery tasks┘
```

Dependencies point inward. Both delivery mechanisms — HTTP and Celery tasks — are thin
and call the same use cases. The **domain** (`src/domain/`) imports no framework. See
`docs/architecture/`.

## Directory structure

```
manage.py                 Django management entry point
requirements*.txt         runtime / dev dependencies
Dockerfile  docker-compose.yml   local orchestration (db, rabbitmq, redis, web, worker, beat, flower)
Makefile  pyproject.toml  .pre-commit-config.yaml   tooling
.github/  .gitlab/         source-control host config
.ai/                       repo-level AI config: agents, prompts, tools, workflows, memory
docs/                      architecture, development, ai, project-management, deployment, security
src/
  config/                  Django project: settings, urls, celery, wsgi/asgi
  api/                     DRF delivery layer: routers, serializers, views (thin)
  application/              use cases / orchestration + port interfaces (plain Python)
  domain/                   business concepts and rules (plain Python; no django/celery)
  infrastructure/           Postgres ORM models + migrations, repositories, Celery tasks, clients
  ai/                       application AI: agents, providers, tools, prompts, memory
tests/                     unit / integration / end_to_end  (pytest)
scripts/                   developer/ops helper scripts
config/                    per-environment non-sensitive config placeholders
.env.example               environment variable names (no values)
AGENTS.md                  rules for AI coding agents
```

## Backing services
| Service | Purpose | Env var |
|---|---|---|
| PostgreSQL 16 | primary datastore | `DATABASE_URL` |
| RabbitMQ 3.13 | Celery message broker | `CELERY_BROKER_URL` |
| Redis 7 | cache, sessions, optional task results | `REDIS_URL` |

Details: `docs/development/services.md`.

## Observability
`/metrics` (Prometheus via `django-prometheus`), `/health/` (`django-health-check`:
DB, cache, migrations, Redis, Celery), Sentry (errors from Django + Celery, enabled when
`SENTRY_DSN` is set), `structlog` for structured logs.

## AI architecture
- `.ai/` — configuration guiding agents that work *on this repo*.
- `src/ai/` — the product's own AI code, added later, behind provider-neutral interfaces.
- No AI provider installed. An agent = instructions + model provider + tools + memory +
  workflow, wired through interfaces. See `docs/ai/`.

## Source-control workflow
`Issue → Branch → Commit → Pull/Merge Request → Review → CI → Merge`. Branches: `main`,
`feature/*`, `fix/*`, `refactor/*`, `chore/*`, `docs/*`. Conventional Commits. See
`docs/project-management/`.

## Development principles
- Simple over clever; abstraction only when it pays for itself.
- Respect layer boundaries; domain and application stay framework-free.
- A new dependency requires an ADR.
- Long/blocking work goes to Celery, not request handlers.
- Tests accompany real behavior; docs track architecture changes.

## Next step
Model the first domain concept in `src/domain/`, a use case in `src/application/` with a
repository port, its Postgres-ORM implementation + migration in `src/infrastructure/`, a
DRF view in `src/api/`, and (if it needs async work) a thin task in
`src/infrastructure/tasks.py` — then add unit and integration tests.
