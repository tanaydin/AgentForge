# Agents

## Conceptual structure

```
Agent
 |-- Instructions      (role, boundaries, allowed actions)
 |-- Model provider    (via provider-neutral interface)
 |-- Tools             (explicit schemas + permissions)
 |-- Memory            (retrieval of long-lived context)
 |-- Workflow          (plan -> inspect -> implement -> test -> review -> document)
```

## Rules
- An agent communicates with a model through an interface, not a vendor SDK.
- An agent's capabilities are the sum of its explicitly granted tools.
- Agent instructions live in `.ai/agents/` (repo agents) or are defined alongside
  `src/ai/agents/` (application agents).
- Least privilege: grant the minimum tools and permissions needed.
