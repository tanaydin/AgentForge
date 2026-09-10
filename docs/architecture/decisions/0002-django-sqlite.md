# 0002 - Django + SQLite as the initial stack

- **Status**: accepted
- **Date**: 2026-09-10
- **Supersedes**: partially ADR 0001 (the "no dependencies" stance) — 0001's *principle*
  (introduce dependencies deliberately, via ADRs) still holds.

## Context
ADR 0001 kept the repository dependency-free while the stack was undecided. The team has
now chosen the implementation stack for the first vertical slice.

## Decision
- **Language**: Python (3.12+).
- **Web framework**: Django, latest stable line (`>=6.1,<6.2`; Django 6.1 as of
  2026-09-10), added to `requirements.txt`. Track the current stable series and bump the
  pin in a follow-up ADR when a new minor is adopted.
- **Database**: SQLite via Django's bundled `django.db.backends.sqlite3`. No database
  server, driver package, or container is required.
- **Project layout**: the Django project package is `src/config` (`DJANGO_SETTINGS_MODULE
  = src.config.settings`). Django apps and framework-touching code live in `src/api`
  (delivery) and `src/infrastructure` (ORM models, migrations, repositories).
- **Boundaries preserved**: `src/domain` and `src/application` remain plain Python and
  must not import `django`. The ORM stays in `src/infrastructure`; repositories translate
  between ORM rows and domain objects.
- **Test runner**: Django's built-in test runner (`python manage.py test`). `pytest` /
  `pytest-django` may be adopted later via a follow-up ADR.

## Consequences
- The repo now has one runtime dependency (Django). `pip install -r requirements.txt` is
  required to run anything.
- `db.sqlite3` is git-ignored; migrations under `src/infrastructure/migrations/` are
  committed.
- SQLite is sufficient for development and small deployments. Moving to
  PostgreSQL/MySQL later is a settings + driver change and will get its own ADR.
- Secrets (`SECRET_KEY`, etc.) come from the environment; `.env.example` lists the names.
