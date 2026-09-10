# Security

Stack: **Django 6.1 + PostgreSQL + Celery/RabbitMQ + Redis** (ADR 0002).

## Secrets
- `SECRET_KEY`, `DATABASE_URL`, `CELERY_BROKER_URL`, `REDIS_URL`, `SENTRY_DSN` come from
  the environment / secret manager. `.env` is git-ignored; `.env.example`
  lists names only.
- Rotate broker and database credentials on staff changes.

## Django
- `DEBUG=False` and explicit `ALLOWED_HOSTS` / `CSRF_TRUSTED_ORIGINS` outside local dev.
- Production toggles on when `DEBUG=False`: SSL redirect, HSTS, secure cookies,
  `SECURE_PROXY_SSL_HEADER`.
- Keep Django and all dependencies patched (loose upper bounds; bump deliberately).
- Use the ORM / parameterized queries; avoid raw SQL string interpolation.
- DRF defaults: `IsAuthenticated`, JSON renderer (Browsable API only when `DEBUG`).

## Services
- Do not expose PostgreSQL, RabbitMQ, or Redis to the public internet; private network +
  auth only. Change default `guest/guest` RabbitMQ and default Postgres credentials.
- RabbitMQ management UI (15672) and Flower (5555) must sit behind auth / VPN.
- Redis: enable auth (`requirepass`) / TLS in shared environments.

## Celery
- Tasks receive ids, not objects; validate all task input as untrusted.
- Assume at-least-once delivery — tasks must be idempotent.
- Never log secrets or full payloads.

## Observability
- Sentry `send_default_pii=False`. Scrub sensitive data before capture.
- `/metrics` and `/health/` should not leak internal detail publicly; restrict if needed.

See `docs/ai/security.md` for AI-specific concerns.
