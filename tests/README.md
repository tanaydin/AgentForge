# tests/

```
tests/
  unit/         isolated, fast, no DB/I-O  -> domain and application logic
  integration/  real SQLite test database  -> repositories, ORM, use cases
  end_to_end/   full flows through Django views (Django test Client)
```

Runner: `python manage.py test` (Django's built-in runner). `pytest`/`pytest-django`
may be adopted via an ADR. Add `__init__.py` to a test package when you add real test
modules. See `docs/development/testing.md`.
