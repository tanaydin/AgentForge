# tests/

Pest 3 (on PHPUnit). Run with `./vendor/bin/sail artisan test` or `./vendor/bin/pest`.

```
tests/
  Unit/         isolated, fast, no I/O          (phpunit testsuite "Unit")
  Feature/      HTTP / Inertia / DB flows        (phpunit testsuite "Feature")
  integration/  optional: components with real adapters
  end_to_end/   optional: full flows through the UI
```

`Pest.php` binds `Tests\TestCase` and `RefreshDatabase` to the `Feature` suite.
See `docs/development/testing.md`.
