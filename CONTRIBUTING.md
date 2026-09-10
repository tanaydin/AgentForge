# Contributing

Stack: **Python 3.12+ / Django 6.1 / SQLite** (ADR 0002).

## Setup

```
python -m venv .venv && source .venv/bin/activate
pip install -r requirements-dev.txt
python manage.py migrate
python manage.py test
```

## Workflow

```
Issue -> Branch -> Commit -> Pull/Merge Request -> Review -> CI -> Merge
```

1. Open or pick an issue describing the change.
2. Branch from `main`: `feature/*`, `fix/*`, `refactor/*`, `chore/*`, `docs/*`.
3. Make focused commits using [Conventional Commits](https://www.conventionalcommits.org/):
   `feat: fix: refactor: docs: test: chore: perf: ci: build:`.
4. Open a Pull/Merge Request using the template; fill in the checklist.
5. Address review; ensure `python manage.py test` and `python manage.py migrate --check`
   pass (CI will enforce this once it exists).
6. Squash or rebase-merge to `main`; delete the branch.

## Rules
- Respect architectural boundaries — see `docs/architecture/`.
- `src/domain/` and `src/application/` must not import `django`.
- New dependency (beyond Django) => new ADR in `docs/architecture/decisions/`.
- No secrets in the repo. Commit migrations.
- Add tests for real behavior; update docs when architecture changes.

## Where things go
See each directory's `README.md` and `AGENTS.md`.
