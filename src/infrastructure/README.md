# src/infrastructure/

## Purpose
Adapter layer. Concrete implementations of the port interfaces declared by
`application/` and `domain/`: persistence, messaging, external HTTP APIs, and AI provider
clients.

## What belongs here
- Repository implementations (DB access)
- API/gateway clients
- Message queue producers/consumers
- AI provider adapters (implementing a provider-neutral interface)

## What does NOT belong here
- Business rules
- Use-case orchestration
- HTTP route definitions (`api/`)

## Example future files
- `src/infrastructure/persistence/order-repository.*`
- `src/infrastructure/ai/openai-provider.*`

## Dependencies that may eventually be introduced
Database drivers, HTTP clients, message-queue clients, AI SDKs — each via an ADR.
