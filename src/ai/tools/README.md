# src/ai/tools

## Purpose
Callable tools an agent may invoke (filesystem, database, web, Git, GitHub, GitLab, Jira, Linear, internal APIs, MCP tools). Each defines input/output schema, authorization, validation, logging, error handling, and restricted permissions.

## What belongs here
- Implementation code for this concern, added later
- Interfaces and their concrete implementations as appropriate to the layer

## What does NOT belong here
- Vendor SDK imports outside `providers/`
- Business rules (those belong in `src/domain/`)
- Secrets

## Example future files
- `src/ai/tools/github-tool.*`

## Dependencies that may eventually be introduced
Deferred; introduced via an ADR when this concern is implemented.
