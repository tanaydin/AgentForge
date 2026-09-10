# Security

Stack: **Django + SQLite** (ADR 0002).

- `SECRET_KEY` and other secrets come from the environment, never the repo. `.env.example`
  lists names only; `.env` and `db.sqlite3` are git-ignored.
- `DEBUG=False` and an explicit `ALLOWED_HOSTS` in any non-local environment.
- Keep Django patched (`Django>=6.1,<6.2`); review security releases.
- Use the ORM / parameterized queries; avoid raw SQL string interpolation.
- Keep Django's security middleware enabled; add CSRF/session/auth middleware when views
  that need them are introduced.
- Least privilege for all credentials, tools, and (future) CI jobs.
- See `docs/ai/security.md` for AI-specific concerns.
