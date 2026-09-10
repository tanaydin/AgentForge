# Changelog

All notable changes to this project are documented here.
Format based on [Keep a Changelog](https://keepachangelog.com/); versioning follows
[Semantic Versioning](https://semver.org/) once the project ships.

## [Unreleased]
### Added
- Dependency-free architectural scaffold: directory structure, per-directory `README.md`
  documentation, architecture docs, AI foundation (`.ai/`, `src/ai/`), source-control and
  project-management conventions, environment placeholders, `AGENTS.md`, ADR
  `0001-dependency-free-scaffold`.
- **Django + SQLite stack** (ADR `0002-django-sqlite`): `requirements.txt` (Django),
  `manage.py`, Django project package `src/config/` (`settings.py`, `urls.py`, `wsgi.py`,
  `asgi.py`), `src/api/` delivery app with a `/health/` view, and `__init__.py` markers
  for the `src` layers.

### Changed
- Documentation (architecture, coding standards, testing, deployment, security, README,
  `AGENTS.md`) updated from technology-agnostic to Django + SQLite specifics while
  preserving the layered boundaries (domain stays framework-free).
