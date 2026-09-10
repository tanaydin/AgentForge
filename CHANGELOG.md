# Changelog

All notable changes to this project are documented here.
Format based on [Keep a Changelog](https://keepachangelog.com/); versioning follows
[Semantic Versioning](https://semver.org/) once the project ships.

## [Unreleased]
### Added
- Dependency-free architectural scaffold: directory structure, per-directory `README.md`
  docs, architecture docs, AI foundation (`.ai/`, `src/ai/`), source-control and
  project-management conventions, `AGENTS.md`, ADR `0001-dependency-free-scaffold`.
- **Django + PostgreSQL production stack** (ADR `0002-production-stack`): `manage.py`,
  `src/config/` project package, `src/api/` DRF app, layer `__init__.py` markers, plus:
  - PostgreSQL (`psycopg` 3) as the database in every environment (no SQLite phase).
  - Celery 5 with RabbitMQ broker, `django-celery-results` + `django-celery-beat`;
    Celery app at `src/config/celery.py`, task wrappers at `src/infrastructure/tasks.py`.
  - Redis for cache, sessions, and optional task results (`django-redis`).
  - Django REST Framework + `django-filter` + `django-cors-headers`.
  - Observability: Sentry (`sentry-sdk`), `django-prometheus` (`/metrics`),
    `django-health-check` (`/health/`), `structlog`.
  - WhiteNoise static files; Gunicorn / Uvicorn app servers.
  - `django-environ` 12-factor settings; expanded `.env.example`.
  - `Dockerfile`, `docker-compose.yml` (db, rabbitmq, redis, web, worker, beat, flower),
    `.dockerignore`.
  - Tooling: `pyproject.toml` (ruff, black, mypy + django-stubs, pytest, coverage),
    `.pre-commit-config.yaml`, `Makefile`, `requirements-dev.txt`.

### Changed
- All documentation (architecture, coding standards, testing, deployment, security,
  services, README, `AGENTS.md`, `CONTRIBUTING.md`) updated for the production stack.
  Domain and application layers remain framework-free.
