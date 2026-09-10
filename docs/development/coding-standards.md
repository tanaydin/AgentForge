# Coding standards

Stack: **Python 3.12+ / Django 6.1 / PostgreSQL / Celery+RabbitMQ / Redis** (ADR 0002).

## Structure
- Code lives under `src/` in the layer that matches its responsibility.
- `src/domain/` and `src/application/` are **plain Python** — no `django`, no `celery`
  imports.
- Django/Celery-touching code lives only in `src/config/`, `src/api/`,
  `src/infrastructure/`.
- Cross-layer communication uses port interfaces defined by the inner layer and
  implemented in `src/infrastructure/`.
- Repositories translate ORM rows <-> domain objects at the boundary.

## Tooling (config in `pyproject.toml`)
- **ruff** — lint + import sort + format (`ruff check`, `ruff format`).
- **black** — formatting (kept compatible with ruff).
- **mypy** + django-stubs — type checking (`mypy src`).
- **pre-commit** — runs ruff and `manage.py check` on commit (`pre-commit install`).

## Naming / style
- Modules/packages `snake_case`; classes `PascalCase`; functions/vars `snake_case`.
- PEP 8, line length 100. Type hints on public functions.
- Comments explain *why*, not *what*; match surrounding density.

## Django
- Settings read from the environment via `django-environ`; never hard-code secrets.
- One concern per migration; migrations are committed.
- Keep views and serializers thin; logic goes to `src/application/`.

## Celery
- Tasks in `src/infrastructure/tasks.py`, thin, `@shared_task` with explicit retries.
- Pass ids, not ORM objects. Tasks must be idempotent (`acks_late` is on).
- Long or blocking work belongs in a task, never in a request handler.

## AI code
- Agents depend on provider-neutral interfaces, never a vendor SDK directly.
- Every tool has explicit input/output schemas, authorization, validation, logging, and
  error handling.
