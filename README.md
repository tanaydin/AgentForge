# Project

A Laravel 13 web application backed by MariaDB, with a React (Inertia) frontend.

The repository keeps the technology-agnostic architectural scaffold it started from —
see [`docs/architecture/scaffold-overview.md`](docs/architecture/scaffold-overview.md)
for the layered design (API → Application → Domain → Infrastructure) and
[`AGENTS.md`](AGENTS.md) for the rules AI agents follow here. Technology decisions are
recorded as ADRs in [`docs/architecture/decisions/`](docs/architecture/decisions/)
([0002](docs/architecture/decisions/0002-laravel-mariadb-stack.md) covers this stack).

## Stack

| Concern       | Choice                                                  |
|---------------|--------------------------------------------------------|
| Runtime       | PHP 8.5                                                 |
| Framework     | Laravel 13                                              |
| Database      | MariaDB 11                                              |
| Frontend      | React 19 · Inertia 2 · TypeScript · Tailwind 4 · Vite   |
| Auth          | Laravel React starter kit (Fortify, passkeys, 2FA)      |
| Local env     | Laravel Sail (Docker): app · MariaDB · Redis · Mailpit  |
| Tests         | Pest 3                                                  |
| Lint / types  | Laravel Pint · Larastan (PHPStan)                       |

## Getting started

Requires Docker.

```bash
cp .env.example .env
composer install
npm install
php artisan key:generate

./vendor/bin/sail up -d          # start app, MariaDB, Redis, Mailpit
./vendor/bin/sail artisan migrate
npm run dev                       # Vite dev server
```

App: http://localhost · Mailpit: http://localhost:8025
MariaDB is forwarded to host port **3307**, Redis to **6380** (defaults are left free
for Homebrew services).

Optionally alias Sail: `alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'`

## Common commands

```bash
sail artisan test        # Pest suite
composer lint            # Pint (format)
composer types:check     # PHPStan
sail artisan tinker
sail down                # stop containers
```

## Layout

Laravel's directories (`app/`, `routes/`, `database/`, `resources/`, …) sit at the root.
The scaffold's `src/{domain,application,infrastructure}/` are autoloaded as the
`Domain\`, `Application\`, `Infrastructure\` namespaces for code that should stay
framework-independent. `docs/`, `.ai/`, `.github/`, and `.gitlab/` are unchanged from
the scaffold.
