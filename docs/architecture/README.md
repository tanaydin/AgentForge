# Architecture

This repository runs on **Laravel 13 + MariaDB** (see
[`decisions/0002-laravel-mariadb-stack.md`](decisions/0002-laravel-mariadb-stack.md)).
It began as a dependency-free scaffold; that origin and the layered design below are
described in [`scaffold-overview.md`](scaffold-overview.md). No cloud provider or AI
vendor is chosen yet.

Laravel's own directories (`app/`, `routes/`, `database/`, …) hold framework-facing
code. The layers below map to `src/domain/`, `src/application/`, `src/infrastructure/`,
autoloaded as the `Domain\`, `Application\`, and `Infrastructure\` namespaces — use
them for code that should not depend on the framework.

## Layered architecture and dependency direction

```
        API / UI
           |
           v
       Application layer
           |
           v
        Domain layer
           |
           v
       Infrastructure
```

Dependencies point **downward and inward**. Outer layers depend on inner layers; inner
layers never import outer layers.

- **API / UI** — delivery mechanisms (HTTP, CLI, web UI). Translates external input into
  application calls. Contains no business rules.
- **Application** — use cases / orchestration. Coordinates domain objects and
  infrastructure through interfaces (ports).
- **Domain** — business concepts and rules. Pure. No framework, DB, cloud, or AI vendor
  imports.
- **Infrastructure** — adapters implementing the interfaces the inner layers declare:
  persistence, messaging, external APIs, AI providers.

## AI dependency direction

```
        AI (agents, tools, providers)
                 |
                 v
      Application / Domain (via interfaces)
                 |
                 v
           Infrastructure
```

The domain must **not** depend on a specific AI provider. AI providers are infrastructure
adapters behind a provider-neutral interface.

## Conceptual AI view

```
Agents  ->  Tools  ->  Providers
   |
 Memory
   |
Workflows
```

See `docs/ai/` for detail and `docs/architecture/decisions/` for ADRs.
