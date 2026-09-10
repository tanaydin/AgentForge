# src/application/

## Purpose
Use-case layer. Orchestrates domain objects and infrastructure to fulfill a request. One
use case = one unit of application behavior.

## What belongs here
- Use-case / service / interactor classes
- Port interfaces (repositories, gateways, AI providers) that infrastructure implements
- Transaction and workflow coordination

## What does NOT belong here
- HTTP/CLI concerns (`api/`)
- Business invariants (`domain/`)
- Concrete adapters (`infrastructure/`)

## Example future files
- `src/application/create-order.*`
- `src/application/ports/order-repository.*`

## Dependencies that may eventually be introduced
Ideally none beyond the language standard library.
