# .ai

## Purpose
Repository-level AI configuration: instructions, prompts, tool definitions and workflows that guide AI coding agents and automation working *on this repo*. This is configuration and documentation, not application code.

## What belongs here
- Agent instruction files
- Reusable prompt templates
- Tool/MCP descriptors (schemas, permissions)
- Agent workflow definitions
- Curated long-lived context ('memory')

## What does NOT belong here
- Application runtime AI code (that lives in `src/ai/`)
- Secrets or API keys
- Vendor SDKs

## Example future files
- `.ai/agents/reviewer.md`
- `.ai/prompts/commit-message.md`
- `.ai/tools/github.json`
- `.ai/workflows/release.md`

## Dependencies that may eventually be introduced
None. This directory stays dependency-free.
