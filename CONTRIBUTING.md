# Contributing

## Workflow

```
Issue -> Branch -> Commit -> Pull/Merge Request -> Review -> CI -> Merge
```

1. Open or pick an issue describing the change.
2. Branch from `main`: `feature/*`, `fix/*`, `refactor/*`, `chore/*`, `docs/*`.
3. Make focused commits using [Conventional Commits](https://www.conventionalcommits.org/):
   `feat: fix: refactor: docs: test: chore: perf: ci: build:`.
4. Open a Pull/Merge Request using the template; fill in the checklist.
5. Address review; ensure CI passes (once CI exists).
6. Squash or rebase-merge to `main`; delete the branch.

## Rules
- Respect architectural boundaries — see `docs/architecture/`.
- New dependency ⇒ new ADR in `docs/architecture/decisions/`.
- No secrets in the repo.
- Add tests for real behavior; update docs when architecture changes.
- Keep the domain layer pure.

## Where things go
See each directory's `README.md` and `AGENTS.md`.
