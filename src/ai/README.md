# src/ai/

## Purpose
Application-level AI implementation used by the product at runtime. Distinct from `.ai/`,
which is repository-level configuration for agents working on the repo.

```
src/ai/
  agents/     runtime agent definitions (instructions + wiring)
  providers/  model provider adapters behind a provider-neutral interface
  tools/      callable tools/MCP integrations with explicit schemas
  prompts/    version-controlled prompt templates used at runtime
  memory/     retrieval / long-lived context stores
```

## Rules
- Agents and use cases depend on a **provider-neutral interface**, never a vendor SDK
  directly. Concrete provider clients live in `providers/` (or `infrastructure/ai/`).
- No provider is implemented yet. Candidates: OpenAI, Anthropic, Google, Ollama, other
  local models, others.
- The domain layer never imports anything from here.
