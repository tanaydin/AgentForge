# Architecture

This repository is a **dependency-free architectural scaffold**. No framework, database,
cloud provider, or AI vendor is chosen yet.

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
