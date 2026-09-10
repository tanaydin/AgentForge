# Architecture Decision Records (ADRs)

Each significant, hard-to-reverse decision is recorded as one immutable file:

```
0001-title.md
0002-title.md
0003-title.md
```

## Format
- **Status**: proposed | accepted | superseded by ADR-XXXX
- **Context**: forces at play
- **Decision**: what was chosen
- **Consequences**: trade-offs, follow-ups

## Rules
- Never edit an accepted ADR's decision; supersede it with a new ADR instead.
- Create an ADR only for decisions with real consequences. Do not manufacture ADRs.

Current ADRs:
- `0001-dependency-free-scaffold.md`
- `0002-production-stack.md` — Django + PostgreSQL + Celery/RabbitMQ + Redis
