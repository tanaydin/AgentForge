# Tools / MCP

Future tools (filesystem, database, web, Git, GitHub, GitLab, Jira, Linear, internal
APIs, MCP servers) will live under `src/ai/tools/`. None are implemented.

## Every tool must define
- Explicit **input schema**
- Explicit **output schema**
- **Authorization** model (who/what may call it)
- **Validation** of inputs and outputs
- **Logging** of invocations
- **Error handling** with safe failure modes
- **Restricted permissions** (least privilege)

Tool *descriptors* (schema + policy, no implementation) may be kept in `.ai/tools/`.
