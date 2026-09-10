# Testing

Runner: **pytest + pytest-django** (config in `pyproject.toml`).

## Layout
```
tests/
  unit/         isolated, fast, NO database, NO broker -> domain + application logic
  integration/  real Postgres test DB, real Celery in eager mode -> repositories, tasks, use cases
  end_to_end/   full flows through DRF (APIClient) and/or task dispatch
```

## Services in tests
- **PostgreSQL**: pytest-django creates/destroys a test database. `--reuse-db` speeds
  local runs. CI uses a Postgres service container.
- **Celery**: run tasks synchronously with `CELERY_TASK_ALWAYS_EAGER = True` (set via a
  fixture or test settings) — no RabbitMQ needed for most tests. Test the broker wiring
  separately if required.
- **Redis**: use Django's `locmem` cache in tests, or a disposable Redis in CI.

## Rules
- Unit tests must not hit the database, cache, or broker.
- Add tests for implemented behavior, not scaffold placeholders.
- Mark slow/integration tests so they can be selected: `pytest -m "not slow"`.

## Commands
```
pytest                         # everything
pytest tests/unit              # one package
pytest -n auto                 # parallel (pytest-xdist)
pytest --cov                   # coverage
```
