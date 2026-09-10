# src/ai/prompts

## Purpose
Prompt templates used by the application at runtime. Version-controlled text with documented inputs and expected output shape.

## What belongs here
- Implementation code for this concern, added later
- Interfaces and their concrete implementations as appropriate to the layer

## What does NOT belong here
- Vendor SDK imports outside `providers/`
- Business rules (those belong in `src/domain/`)
- Secrets

## Example future files
- `src/ai/prompts/summarize.md`

## Dependencies that may eventually be introduced
Deferred; introduced via an ADR when this concern is implemented.
