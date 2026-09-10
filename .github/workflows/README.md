# .github/workflows/

## Purpose
Placeholder for GitHub Actions workflow files (`*.yml`).

## What belongs here (later)
- `ci.yml` — lint, test, build on push and pull request
- `release.yml` — tagging and changelog automation

## Status
No CI is configured yet (see ADR `0001-dependency-free-scaffold`). The intended flow once
CI exists:

```
Issue -> Branch -> Commit -> Pull Request -> Review -> CI -> Merge
```

## Rules
- No secrets in workflow files; use repository/organization secrets.
- Jobs run with least privilege (`permissions:` set explicitly).
