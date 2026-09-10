# .github/workflows/

## Purpose
Placeholder for GitHub Actions workflow files (`*.yml`).

## What belongs here (later)
- `ci.yml` — on push and pull request:
  - `pip install -r requirements-dev.txt`
  - `python manage.py migrate --check`
  - `python manage.py test`
  - (optional) lint/format check once a linter is adopted via ADR
- `release.yml` — tagging and changelog automation

## Status
No CI is configured yet. Intended flow:

```
Issue -> Branch -> Commit -> Pull Request -> Review -> CI -> Merge
```

## Rules
- No secrets in workflow files; use repository/organization secrets.
- Jobs run with least privilege (`permissions:` set explicitly).
