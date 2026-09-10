# src/infrastructure/

## Purpose
Adapter layer. Concrete implementations of the interfaces (ports) declared by
`application/` and `domain/`. With **Django + SQLite**, this is where the ORM lives.

## What belongs here
- Django `models.py` (persistence schema) and the generated `migrations/`
- Repository implementations that map ORM rows <-> domain objects
- Clients for external HTTP APIs, message queues
- AI provider adapters (implementing a provider-neutral interface)

## What does NOT belong here
- Business rules (`src/domain/`)
- Use-case orchestration (`src/application/`)
- HTTP routing/views (`src/api/`)

## Notes on Django
- The domain layer must not import `django.db`. Keep `models.py` here and translate to
  plain domain objects at the repository boundary.
- Database is SQLite (`db.sqlite3` at repo root, git-ignored). Migrations are committed.

## Example future files
- `src/infrastructure/models.py`
- `src/infrastructure/migrations/0001_initial.py`
- `src/infrastructure/repositories/order_repository.py`

## Dependencies
Django ORM (chosen — see ADR 0002). Other drivers/clients via their own ADR.
