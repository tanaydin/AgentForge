# Architecture

Stack: **Django 6.1 + PostgreSQL + Celery/RabbitMQ + Redis** (see ADR 0002, ADR 0002).
The layering below is preserved on top of Django.

## Layered architecture and dependency direction

```
        API / UI  (DRF views, urls)          Celery workers (src/infrastructure/tasks.py)
           |                                        |
           +--------------------+-------------------+
                                v
                     Application layer   (use cases; plain Python)
                                |
                                v
                         Domain layer     (business rules; NO django / celery imports)
                                |
                                v
        Infrastructure  (Postgres ORM + migrations, repositories, Redis, external clients)
```

Dependencies point **inward**. Both delivery mechanisms — HTTP requests and Celery tasks
— are thin and call the same application use cases.

- **API / UI** — `src/api/`. DRF routers/serializers/views. No business rules.
- **Tasks** — `src/infrastructure/tasks.py`. Thin Celery wrappers; parse args → call a
  use case → return a serializable result.
- **Application** — `src/application/`. Use cases / orchestration. Plain Python.
- **Domain** — `src/domain/`. Business concepts and rules. Plain Python. **No `django`,
  no `celery`, no cloud/AI SDK imports.**
- **Infrastructure** — `src/infrastructure/`. PostgreSQL ORM models, `migrations/`,
  repository implementations, Redis access, external API / AI provider adapters, Celery
  task wrappers.
- **Django project package** — `src/config/`: `settings.py`, `urls.py`, `celery.py`,
  `wsgi.py`, `asgi.py`. `DJANGO_SETTINGS_MODULE = src.config.settings`.

## Backing services
PostgreSQL (datastore), RabbitMQ (Celery broker), Redis (cache/sessions/optional
results). See `docs/development/services.md`. Local: `docker compose up`.

## Observability
`/metrics` (Prometheus), `/health/` (health checks), Sentry (errors, Django + Celery).

## AI dependency direction

```
        AI (agents, tools, providers)
                 |
                 v
      Application / Domain (via interfaces)
                 |
                 v
           Infrastructure
```

The domain must not depend on a specific AI provider. AI providers are infrastructure
adapters behind a provider-neutral interface.

See `docs/ai/` and `docs/architecture/decisions/` for ADRs.
