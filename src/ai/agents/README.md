# src/ai/agents

## Purpose
Runtime agent definitions: instructions, tool wiring, memory and workflow configuration. Agents orchestrate a model provider plus tools to accomplish a task.

## What belongs here
- Implementation code for this concern, added later
- Interfaces and their concrete implementations as appropriate to the layer

## What does NOT belong here
- Vendor SDK imports outside `providers/`
- Business rules (those belong in `src/domain/`)
- Secrets

## Example future files
- `src/ai/agents/planner-agent.*`

## Dependencies that may eventually be introduced
Deferred; introduced via an ADR when this concern is implemented.
