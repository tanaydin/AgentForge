# Coding standards

Language-agnostic until a stack is chosen. General rules:

## Structure
- Code lives under `src/` in the layer that matches its responsibility.
- Inner layers (`domain`, `application`) never import outer layers (`api`,
  `infrastructure`).
- Cross-layer communication uses interfaces defined by the inner layer and implemented by
  the outer layer.

## Naming
- Directories and files: `kebab-case` (or the idiomatic case of the chosen language).
- Names describe intent, not implementation detail.

## Comments
- Match the density and idiom of surrounding code.
- Explain *why*, not *what*.

## AI code
- Agents depend on provider-neutral interfaces, never a vendor SDK directly.
- Every tool has explicit input/output schemas, authorization, validation, logging, and
  error handling.
