# src/ai/memory

## Purpose
Long-lived context storage and retrieval for agents (conventions, prior results, embeddings index). Storage backend is an infrastructure concern behind an interface.

## What belongs here
- Implementation code for this concern, added later
- Interfaces and their concrete implementations as appropriate to the layer

## What does NOT belong here
- Vendor SDK imports outside `providers/`
- Business rules (those belong in `src/domain/`)
- Secrets

## Example future files
- `src/ai/memory/conversation-store.*`

## Dependencies that may eventually be introduced
Deferred; introduced via an ADR when this concern is implemented.
