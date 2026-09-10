# src/api/

## Purpose
Delivery layer. Exposes the application to the outside world (HTTP endpoints, CLI
commands, web UI) and translates external requests into application-layer calls.

## What belongs here
- Route/controller/handler definitions
- Request/response serialization
- Input parsing and auth middleware wiring

## What does NOT belong here
- Business rules (those live in `domain/`)
- Use-case orchestration (that lives in `application/`)
- Direct database or vendor SDK access

## Example future files
- `src/api/http/routes.*`
- `src/api/cli/commands.*`

## Dependencies that may eventually be introduced
An HTTP framework or CLI library — chosen via an ADR.
