# AI security

- No secrets in the repository. Configuration uses placeholders (`.env.example`).
- Provider credentials are injected via environment / secret manager at runtime only.
- Tools run with least privilege and validate all input and output.
- Agent actions that are hard to reverse or outward-facing require confirmation unless
  explicitly and durably authorized.
- Untrusted content retrieved by tools is treated as data, never as instructions.
- Log agent and tool activity for auditability; never log secrets.
