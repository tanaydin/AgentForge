# Project

Stack: **Python 3.12+ / Django 6.1 / SQLite** (see `docs/architecture/decisions/0002-django-sqlite.md`).
The repository keeps a layered architecture on top of Django: the domain and application
layers are plain Python and never import `django`.

## Quick start

```
python -m venv .venv && source .venv/bin/activate
pip install -r requirements.txt
python manage.py migrate
python manage.py runserver
# GET http://127.0.0.1:8000/health/  ->  {"status": "ok"}
python manage.py test
```

`DJANGO_SETTINGS_MODULE` is `src.config.settings`. Run all commands from the repo root.

## Architecture

```
API / UI (Django)  ->  Application  ->  Domain  ->  Infrastructure (Django ORM + SQLite)
```

Dependencies point inward. The **domain** (`src/domain/`) is plain Python — no framework,
database, cloud, or AI-vendor imports. **Infrastructure** (`src/infrastructure/`) holds
the ORM models, migrations, and repository implementations that satisfy interfaces the
inner layers declare.

```
AI (agents -> tools -> providers; memory; workflows)
      |
      v
Application / Domain   (via provider-neutral interfaces)
      |
      v
Infrastructure
```

Details: `docs/architecture/`. Decisions: `docs/architecture/decisions/`.

## Directory structure

```
manage.py           Django management entry point
requirements.txt    runtime dependencies (Django)
.github/            GitHub issue/PR templates, workflow placeholder
.gitlab/            GitLab config placeholder
.ai/                repo-level AI config: agents, prompts, tools, workflows, memory
docs/               architecture, development, ai, project-management, deployment, security
src/
  config/           Django project: settings.py, urls.py, wsgi.py, asgi.py
  api/              Django delivery layer: urls.py, views.py  (thin)
  application/      use cases / orchestration + port interfaces (plain Python)
  domain/           business concepts and rules (plain Python; NO django imports)
  infrastructure/   Django ORM models + migrations, repositories, external clients
  ai/               application AI: agents, providers, tools, prompts, memory
tests/              unit / integration / end_to_end
scripts/            developer/ops helper scripts
config/             per-environment non-sensitive config placeholders
.env.example        environment variable names (no values)
AGENTS.md           rules for AI coding agents
CONTRIBUTING.md     workflow and conventions
CHANGELOG.md        Keep a Changelog format
LICENSE             not yet chosen
```

## Database
SQLite via `django.db.backends.sqlite3`. The database file is `db.sqlite3` in the repo
root (git-ignored). Migrations under `src/infrastructure/migrations/` are committed.
Set `DATABASE_URL=sqlite:////abs/path/db.sqlite3` to relocate it. Moving to
PostgreSQL/MySQL later is a settings + driver change with its own ADR.

## AI architecture
- `.ai/` — configuration guiding agents that work *on this repo*.
- `src/ai/` — the product's own AI code, added later, behind provider-neutral interfaces.
- No AI provider installed. Candidates: OpenAI, Anthropic, Google, Ollama, other local
  models. An agent = instructions + model provider + tools + memory + workflow, wired
  through interfaces. See `docs/ai/`.

## Source-control workflow

```
Issue -> Branch -> Commit -> Pull/Merge Request -> Review -> CI -> Merge
```

Branches: `main`, `feature/*`, `fix/*`, `refactor/*`, `chore/*`, `docs/*`.
Commits: Conventional Commits. See `docs/project-management/`.

## Project-management workflow
`Epic -> Feature -> Story -> Task -> Sub-task`, plus Bug / Tech debt / Security / Research
/ Spike. Tool-neutral; can later integrate GitHub Projects, GitLab, Jira, Linear. See
`docs/project-management/`.

## Development principles
- Simple over clever; abstraction only when it pays for itself.
- Respect layer boundaries; the domain stays framework-free.
- A new dependency requires an ADR that justifies it.
- Tests accompany real behavior; docs track architecture changes.

## Next step
Model the first domain concept in `src/domain/`, a use case in `src/application/` with a
repository port, its Django-ORM implementation + migration in `src/infrastructure/`, and
a view in `src/api/` — then add unit and integration tests.
