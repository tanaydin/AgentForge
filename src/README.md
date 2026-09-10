# src/

Application source code, organized by architectural layer, implemented with **Django +
SQLite**.

```
src/
  config/         Django project: settings, urls, wsgi/asgi  (DJANGO_SETTINGS_MODULE=src.config.settings)
  api/            Django delivery layer: urls, views, serializers (thin)
  application/    use cases / orchestration + port interfaces (plain Python)
  domain/         business concepts and rules (plain Python; no django imports)
  infrastructure/ adapters: Django ORM models + migrations, repositories, external clients
  ai/             application-level AI implementation (behind interfaces)
```

Dependency direction: `api -> application -> domain`. `infrastructure` and `ai` implement
interfaces the inner layers declare. **The domain never imports `django`.**

Common commands (run from repo root):

```
python -m venv .venv && source .venv/bin/activate
pip install -r requirements.txt
python manage.py migrate
python manage.py runserver      # GET /health/ -> {"status": "ok"}
python manage.py test
```
