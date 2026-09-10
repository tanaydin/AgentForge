# Coding standards

Stack: **Python 3.12+ / Django 6.1 / SQLite** (ADR 0002).

## Structure
- Code lives under `src/` in the layer that matches its responsibility.
- `src/domain/` and `src/application/` are **plain Python** — no `django` imports.
- Django-touching code (`models.py`, migrations, views, urls, settings) lives in
  `src/config/`, `src/api/`, and `src/infrastructure/` only.
- Cross-layer communication uses port interfaces defined by the inner layer and
  implemented in `src/infrastructure/`.
- Repositories translate ORM rows <-> domain objects at the boundary.

## Naming
- Modules and packages: `snake_case`.
- Classes: `PascalCase`. Functions/variables: `snake_case`.
- Names describe intent, not implementation detail.

## Style
- Follow PEP 8. A formatter/linter (ruff/black) may be adopted via a follow-up ADR;
  until then keep diffs clean and consistent with surrounding code.
- Type hints on public functions.

## Comments
- Match the density and idiom of surrounding code. Explain *why*, not *what*.

## Django specifics
- Settings read from the environment; never hard-code secrets.
- One concern per migration; migrations are committed.
- Keep views thin; push logic into `src/application/`.

## AI code
- Agents depend on provider-neutral interfaces, never a vendor SDK directly.
- Every tool has explicit input/output schemas, authorization, validation, logging, and
  error handling.
