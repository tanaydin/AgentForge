# AI documentation

How AI capabilities are organized in this repository.

## Two locations, two purposes

| Location | Purpose |
|----------|---------|
| `.ai/` | Repository-level AI configuration: agent instructions, prompt templates, tool descriptors, workflows, curated memory. Guides agents working *on the repo*. |
| `src/ai/` | Application-level AI implementation added later: agents, provider adapters, tools, prompts, memory used *by the product at runtime*. |

## Vendor neutrality
No AI provider is installed or configured. Future providers *could* include OpenAI,
Anthropic, Google, Ollama, other local models, or others. They will be added as
infrastructure adapters behind a provider-neutral interface — never imported by the
domain.

See: `agents.md`, `prompts.md`, `tools.md`, `security.md`.
