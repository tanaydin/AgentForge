# 0001 - Dependency-free scaffold

- **Status**: accepted
- **Date**: 2026-09-10

## Context
The project's language, frameworks, database, source-control host, project-management
system, and AI provider(s) are not yet decided. Committing to any of these now would
create rework and bias later choices.

## Decision
The initial repository is a pure filesystem and documentation scaffold. It contains only
directories, `README.md` files, documentation, configuration placeholders, and
convention definitions. No packages, lockfiles, virtual environments, SDKs, frameworks,
databases, containers, or cloud resources are added.

Architectural boundaries (API → Application → Domain → Infrastructure, plus AI behind
interfaces) are documented so that future implementation work has a stable structure.

## Consequences
- The repo cannot "run" anything yet; that is expected.
- Technology choices are deferred and will each get their own ADR.
- Every directory documents its purpose so contributors and AI agents know where code
  belongs before writing it.
- Introducing the first real dependency requires an ADR justifying it.
