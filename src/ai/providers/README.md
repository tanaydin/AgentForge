# src/ai/providers

## Purpose
Adapters that implement the provider-neutral model interface for a specific vendor or local runtime. This is where vendor SDKs would eventually be imported — nowhere else.

## What belongs here
- Implementation code for this concern, added later
- Interfaces and their concrete implementations as appropriate to the layer

## What does NOT belong here
- Vendor SDK imports outside `providers/`
- Business rules (those belong in `src/domain/`)
- Secrets

## Example future files
- `src/ai/providers/anthropic-provider.*`

## Dependencies that may eventually be introduced
Deferred; introduced via an ADR when this concern is implemented.
