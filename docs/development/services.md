# Backing services

The application depends on three external services (12-factor "backing services").
`docker compose up` starts all of them plus the app processes.

| Service | Image | Local port | Purpose | Env var |
|---|---|---|---|---|
| PostgreSQL | `postgres:16-alpine` | 5432 | primary datastore | `DATABASE_URL` |
| RabbitMQ | `rabbitmq:3.13-management-alpine` | 5672, 15672 (UI) | Celery message broker | `CELERY_BROKER_URL` |
| Redis | `redis:7-alpine` | 6379 | cache, sessions, optional task results | `REDIS_URL`, `CELERY_RESULT_BACKEND` |

## Application processes

| Process | Command | Notes |
|---|---|---|
| web | `gunicorn src.config.wsgi:application` (prod) / `manage.py runserver` (dev) | HTTP |
| worker | `celery -A src.config worker -l info` | consumes tasks from RabbitMQ |
| beat | `celery -A src.config beat -l info` | enqueues periodic tasks (schedule in DB) |
| flower | `celery -A src.config flower --port 5555` | task monitoring UI |

## Writing tasks
- Define tasks in `src/infrastructure/tasks.py` (autodiscovered).
- Keep them thin: parse args → call a use case in `src/application/` → return a
  JSON-serializable result.
- Use `@shared_task` with explicit `max_retries` / retry backoff.
- Never pass ORM instances as task arguments — pass ids and reload inside the task.
- Idempotency: assume a task may run more than once (`acks_late` is enabled).

## Observability
- `/metrics` — Prometheus format (`django-prometheus`).
- `/health/` — liveness/readiness (`django-health-check`; covers DB, cache, migrations,
  Redis, Celery ping).
- Sentry captures errors from Django and Celery when `SENTRY_DSN` is set.
