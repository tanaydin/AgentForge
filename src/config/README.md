# src/config/

## Purpose
The **Django project package**: settings, URL configuration, and WSGI/ASGI entry points.
Configuration *values* come from the environment (`.env.example`); this package only
reads and shapes them.

## Contents
- `settings.py` — reads env vars; SQLite database; minimal `INSTALLED_APPS`
- `urls.py` — root URL conf, delegates to per-app `urls.py`
- `wsgi.py` / `asgi.py` — server entry points

`DJANGO_SETTINGS_MODULE` is `src.config.settings`. Run commands from the repo root:

```
python manage.py migrate
python manage.py runserver
python manage.py test
```

## What does NOT belong here
- Secret values (use the environment / a secret manager)
- Business logic
- App code (that goes in `src/api`, `src/application`, `src/domain`, `src/infrastructure`)

## Dependencies
Django (chosen — see ADR 0002).
