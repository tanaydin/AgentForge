# 0002 - Laravel + MariaDB implementation stack

- **Status**: accepted
- **Date**: 2026-09-10
- **Supersedes**: extends [0001](0001-dependency-free-scaffold.md) (scaffold is no longer dependency-free)

## Context
The scaffold (ADR 0001) deferred all technology choices. The project now needs a
running web application. A concrete stack is required.

## Decision
Adopt the following stack, all at their current stable releases:

| Concern            | Choice                                             |
|--------------------|----------------------------------------------------|
| Language / runtime | PHP 8.5                                             |
| Framework          | Laravel 13                                          |
| Database           | MariaDB 11 (LTS line)                               |
| Local environment  | Laravel Sail (Docker): app, MariaDB, Redis, Mailpit |
| Frontend           | React 19 + Inertia 2 + TypeScript + Tailwind 4 + Vite |
| Auth / starter     | Laravel React starter kit (Fortify, passkeys, 2FA) |
| Tests              | Pest 3 (on PHPUnit)                                 |
| Static analysis    | Larastan / PHPStan                                  |
| Formatting         | Laravel Pint                                        |

The Laravel skeleton lives at the repository root. The pre-existing scaffold is
preserved: `docs/`, `.ai/`, `AGENTS.md`, `CONTRIBUTING.md`, and the layered `src/`
directories remain. `src/domain`, `src/application`, and `src/infrastructure` are
wired into Composer PSR-4 autoloading under the top-level `Domain\`, `Application\`,
and `Infrastructure\` namespaces (kept distinct from Laravel's `App\` to avoid
prefix ambiguity) so the inward-pointing architecture from
`docs/architecture/scaffold-overview.md` can be followed within a Laravel app.

## Consequences
- The repo now has `vendor/`, `node_modules/`, lockfiles, and containers.
- Local development requires Docker. `./vendor/bin/sail up -d` starts everything.
- Forwarded host ports are 3307 (MariaDB) and 6380 (Redis) to avoid colliding with
  Homebrew services on the default ports.
- Vendor SDKs remain restricted to `src/infrastructure/` and `src/ai/providers/` per
  AGENTS.md; framework code is the one sanctioned exception at the root.
- Future infrastructure choices (queue driver, cache, cloud host, CI) still get their
  own ADRs.
