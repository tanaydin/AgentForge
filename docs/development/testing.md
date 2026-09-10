# Testing

Test directories exist under `tests/`:

- `tests/unit/` — isolated, fast, no I/O. Domain and application logic.
- `tests/integration/` — components together, real adapters (DB, external APIs) where
  practical.
- `tests/end_to_end/` — full flows through the API/UI.

## Expectations
- Add tests for implemented behavior, not for scaffold placeholders.
- No test framework is chosen yet; that decision gets an ADR.
- CI will run these once a pipeline is introduced.
