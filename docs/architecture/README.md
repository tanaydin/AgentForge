# Architecture

Implemented with **Django + SQLite** (see ADR 0002). The layering below is preserved on
top of Django.

## Layered architecture and dependency direction

```
        API / UI  (Django views, urls)
           |
           v
       Application layer   (use cases; plain Python)
           |
           v
        Domain layer       (business rules; NO django imports)
           |
           v
       Infrastructure      (Django ORM models + migrations, repositories, clients)
```

Dependencies point **inward**. Outer layers depend on inner layers; inner layers never
import outer layers.

- **API / UI** — `src/api/`. Django `urls.py` / `views.py`. Translates HTTP into
  application calls. No business rules.
- **Application** — `src/application/`. Use cases / orchestration. Coordinates domain and
  infrastructure through port interfaces. Plain Python.
- **Domain** — `src/domain/`. Business concepts and rules. Plain Python. **Must not
  import `django`**, `django.db`, cloud SDKs, or AI vendors.
- **Infrastructure** — `src/infrastructure/`. Django ORM `models.py`, `migrations/`,
  repository implementations, external API / AI provider adapters.
- **Django project package** — `src/config/`: `settings.py`, `urls.py`, `wsgi.py`,
  `asgi.py`. `DJANGO_SETTINGS_MODULE = src.config.settings`.

## Database
SQLite (`django.db.backends.sqlite3`). File at `db.sqlite3` in the repo root
(git-ignored). Migrations are committed. Optional `DATABASE_URL`
(`sqlite:////abs/path/db.sqlite3`) overrides the location.

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

## Conceptual AI view

```
Agents  ->  Tools  ->  Providers
   |
 Memory
   |
Workflows
```

See `docs/ai/` for detail and `docs/architecture/decisions/` for ADRs.
