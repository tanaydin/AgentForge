# Security

- No secrets in the repository. `.env.example` documents required variables by name only.
- Report vulnerabilities privately (add a `SECURITY.md` with a contact when the project
  goes public).
- Dependencies (once introduced) are reviewed and pinned; supply-chain risk is
  considered in the ADR that introduces each one.
- Principle of least privilege for all credentials, tools, and CI jobs.
- See `docs/ai/security.md` for AI-specific concerns.
