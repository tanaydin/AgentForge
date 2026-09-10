# Contributing

Stack: **Python 3.12+ / Django 6.1 / PostgreSQL / Celery+RabbitMQ / Redis / DRF** (ADR 0002).

## Setup
```
python -m venv .venv && source .venv/bin/activate
pip install -r requirements-dev.txt
pre-commit install
cp .env.example .env            # set SECRET_KEY
docker compose up --build       # db + rabbitmq + redis + web + worker + beat + flower
```

## Workflow
```
Issue → Branch → Commit → Pull/Merge Request → Review → CI → Merge
```
1. Open or pick an issue.
2. Branch from `main`: `feature/*`, `fix/*`, `refactor/*`, `chore/*`, `docs/*`.
3. Commits use [Conventional Commits](https://www.conventionalcommits.org/):
   `feat: fix: refactor: docs: test: chore: perf: ci: build:`.
4. Open a PR/MR using the template; fill in the checklist.
5. Ensure green: `ruff check .`, `mypy src`, `python manage.py migrate --check`, `pytest`.
6. Squash or rebase-merge to `main`; delete the branch.

## Rules
- Respect architectural boundaries — `docs/architecture/`.
- `src/domain/` and `src/application/` must not import `django` or `celery`.
- New dependency (beyond `requirements*.txt`) ⇒ new ADR.
- No secrets in the repo. Commit migrations.
- Long/blocking work ⇒ Celery task in `src/infrastructure/tasks.py`.
- Add tests for real behavior; update docs when architecture changes.

## Where things go
See each directory's `README.md` and `AGENTS.md`.
