# Deployment

Stack: **Django + SQLite** (ADR 0002).

## Environments
Non-sensitive per-environment values live under `config/` (`development`, `testing`,
`production`). Secrets (`SECRET_KEY`, `ALLOWED_HOSTS`, ...) come from the environment or a
secret manager.

## Run

```
pip install -r requirements.txt
python manage.py migrate
python manage.py collectstatic --noinput      # production
python manage.py runserver                    # development
# production: a WSGI/ASGI server (e.g. gunicorn/uvicorn) pointing at
#   src.config.wsgi:application  /  src.config.asgi:application   (server choice -> ADR)
```

## Database
SQLite is a single file (`db.sqlite3`). For production it must live on persistent
storage; concurrent-write load or multi-instance deployment is the trigger to move to
PostgreSQL/MySQL (own ADR).

## CI
Not configured yet. Intended: install deps, run `python manage.py migrate --check` and
`python manage.py test` on every pull request.
