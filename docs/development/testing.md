# Testing

Test runner: **Django's built-in runner** (`python manage.py test`). `pytest` /
`pytest-django` may be adopted later via an ADR.

## Layout

```
tests/
  unit/         isolated, fast, no DB/I-O -> domain and application logic
  integration/  real DB (SQLite test database) -> repositories, ORM, use cases end-to-end
  end_to_end/   full flows through Django views (Django test Client)
```

Django discovers any `test*.py` under directories that are importable packages. Add
`__init__.py` files when you add real test modules, or configure `TEST_RUNNER` /
`pytest.ini` via an ADR.

## Expectations
- Add tests for implemented behavior, not for scaffold placeholders.
- Unit tests must not hit the database.
- Integration/e2e tests use Django's transactional test case against the SQLite test DB
  (created and destroyed automatically).

## Commands

```
python manage.py test                 # everything
python manage.py test tests.unit      # one package
```
