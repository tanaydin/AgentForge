# Project

> **This repository is currently a dependency-free architectural scaffold.**
> No application functionality exists yet. No language, framework, database, cloud
> provider, or AI vendor has been chosen.

## What this is
A clean, technology-agnostic foundation: directories, documentation, conventions, and
configuration placeholders. It is designed so that AI/LLM features, agentic systems,
MCP/tools, APIs, web apps, project-management integrations, source-control hosts, CI/CD,
testing, security, observability, and cloud services can all be added later without
restructuring.

## Architecture

```
API / UI  ->  Application  ->  Domain  ->  Infrastructure
```

Dependencies point inward. The **domain** is pure — no framework, database, cloud, or AI
vendor imports. **Infrastructure** and **AI** implement interfaces that the inner layers
declare.

```
AI (agents -> tools -> providers; memory; workflows)
      |
      v
Application / Domain   (via provider-neutral interfaces)
      |
      v
Infrastructure
```

Details: `docs/architecture/`. Decisions: `docs/architecture/decisions/`.

## Directory structure

```
.github/            GitHub issue/PR templates, workflow placeholder
.gitlab/            GitLab config placeholder
.ai/                repo-level AI config: agents, prompts, tools, workflows, memory
docs/               architecture, development, ai, project-management, deployment, security
src/
  api/              delivery (HTTP, CLI, UI)
  application/      use cases / orchestration + port interfaces
  domain/           business concepts and rules (pure)
  infrastructure/   adapters: persistence, messaging, external APIs, AI providers
  ai/               application AI: agents, providers, tools, prompts, memory
  config/           configuration loading
tests/              unit / integration / end_to_end
scripts/            developer/ops helper scripts
config/             per-environment non-sensitive config placeholders
.env.example        environment variable names (no values)
AGENTS.md           rules for AI coding agents
CONTRIBUTING.md     workflow and conventions
CHANGELOG.md        Keep a Changelog format
LICENSE             not yet chosen
```

## AI architecture
- `.ai/` — configuration guiding agents that work *on this repo*.
- `src/ai/` — the product's own AI code, added later, behind provider-neutral interfaces.
- No provider installed. Candidates: OpenAI, Anthropic, Google, Ollama, other local
  models, others.
- An agent = instructions + model provider + tools + memory + workflow, all wired through
  interfaces. See `docs/ai/`.

## Source-control workflow

```
Issue -> Branch -> Commit -> Pull/Merge Request -> Review -> CI -> Merge
```

Branches: `main`, `feature/*`, `fix/*`, `refactor/*`, `chore/*`, `docs/*`.
Commits: Conventional Commits. See `docs/project-management/`.

## Project-management workflow
`Epic -> Feature -> Story -> Task -> Sub-task`, plus Bug / Tech debt / Security / Research
/ Spike. Tool-neutral; can later integrate GitHub Projects, GitLab, Jira, Linear, or
others. See `docs/project-management/`.

## Development principles
- Simple over clever; abstraction only when it pays for itself.
- Respect layer boundaries; keep the domain pure.
- A new dependency requires an ADR that justifies it.
- Tests accompany real behavior; docs track architecture changes.

## How to introduce a dependency
1. Write an ADR in `docs/architecture/decisions/` (context, decision, consequences).
2. Add it in the correct layer — vendor SDKs only in `infrastructure/` or
   `src/ai/providers/`.
3. Pin the version; note supply-chain considerations.
4. Update this README and `CHANGELOG.md`.

## Next step
Choose the implementation language and, with an ADR each, the first framework, test
runner, and (if needed) AI provider — then implement the first vertical slice through
`api -> application -> domain`.
