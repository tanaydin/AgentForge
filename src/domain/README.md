# src/domain/

## Purpose
Business concepts and rules. Plain Python only. **Must not import Django**, `django.db`,
SQLite APIs, cloud SDKs, or AI vendors.

## What belongs here
- Entities, value objects, aggregates (plain classes / dataclasses)
- Domain services and invariants
- Domain events

## What does NOT belong here
- `django.*` imports of any kind
- I/O (HTTP, DB, filesystem, network)
- Configuration reading

## Example future files
- `src/domain/order.py`
- `src/domain/money.py`

## Dependencies
None. Framework independence is enforced by review.
