# Deployment

Stack: **Django 6.1 + PostgreSQL + Celery/RabbitMQ + Redis** (ADR 0002).

## Deployables
| Process | Command |
|---|---|
| web | `gunicorn src.config.wsgi:application --bind 0.0.0.0:8000 --workers N` |
| worker | `celery -A src.config worker -l info --concurrency N` |
| beat (one instance only) | `celery -A src.config beat -l info` |
| flower (optional) | `celery -A src.config flower` |

ASGI alternative: `uvicorn src.config.asgi:application`.

## Managed / external services
- **PostgreSQL** — managed instance; connection via `DATABASE_URL`. Backups + PITR.
- **RabbitMQ** — managed broker or clustered; `CELERY_BROKER_URL`.
- **Redis** — managed cache; `REDIS_URL`.

## Release steps
```
pip install -r requirements.txt
python manage.py migrate --check        # fail the deploy if migrations are missing
python manage.py migrate
python manage.py collectstatic --noinput
python manage.py check --deploy
# then roll web + worker; run beat as a single instance
```

## Configuration
All via environment variables (see `.env.example`). No `.env` file in production —
inject through the platform / secret manager. Required in production: `SECRET_KEY`,
`DEBUG=false`, `ALLOWED_HOSTS`, `DATABASE_URL`, `CELERY_BROKER_URL`, `REDIS_URL`,
`CSRF_TRUSTED_ORIGINS`. Recommended: `SENTRY_DSN`.

## Local
```
cp .env.example .env      # set SECRET_KEY
docker compose up --build
# web http://localhost:8000  | flower :5555 | rabbitmq UI :15672
```

## CI (not configured yet)
Intended per pull request: install deps → `ruff check` → `mypy src` →
`python manage.py migrate --check` → `pytest` against ephemeral Postgres/RabbitMQ/Redis
service containers.
