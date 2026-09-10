# src/

Application source code, organized by architectural layer. Currently only `README.md`
placeholders — no implementation yet.

```
src/
  api/            delivery mechanisms (HTTP, CLI, UI)
  application/    use cases / orchestration
  domain/         business concepts and rules (pure)
  infrastructure/ adapters: persistence, messaging, external APIs, AI providers
  ai/             application-level AI implementation (behind interfaces)
  config/         configuration loading (values come from environment)
```

Dependency direction: `api -> application -> domain`, with `infrastructure` and `ai`
implementing interfaces declared by the inner layers. The domain imports nothing outward.
