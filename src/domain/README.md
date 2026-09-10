# src/domain/

## Purpose
Contains business concepts and rules. Domain code must remain independent from
frameworks, databases, cloud services, and AI vendors.

## What belongs here
- Entities, value objects, aggregates
- Domain services and business invariants
- Domain events

## What does NOT belong here
- I/O of any kind (HTTP, DB, filesystem, network)
- Framework, ORM, cloud SDK, or AI vendor imports
- Configuration reading

## Example future files
- `src/domain/order.*`
- `src/domain/money.*`

## Dependencies that may eventually be introduced
None. The domain stays dependency-free by design.
