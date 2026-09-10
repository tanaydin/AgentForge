# src/application/

## Purpose
Use-case layer. Orchestrates domain objects and infrastructure through interfaces
(ports). Plain Python; **no `django.*` imports** beyond, at most, exception types kept at
the boundary.

## What belongs here
- Use-case / service / interactor functions or classes
- Port interfaces (repositories, gateways, AI providers) implemented in
  `src/infrastructure/`
- Transaction coordination (via an injected unit-of-work, not `django.db` directly)

## What does NOT belong here
- HTTP/view concerns (`src/api/`)
- ORM models and queries (`src/infrastructure/`)
- Business invariants (`src/domain/`)

## Example future files
- `src/application/create_order.py`
- `src/application/ports/order_repository.py`

## Dependencies
Standard library only, ideally.
