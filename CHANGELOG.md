# Changelog

All notable changes to this project are documented here.
Format based on [Keep a Changelog](https://keepachangelog.com/); versioning will follow
[Semantic Versioning](https://semver.org/) once the project ships.

## [Unreleased]
### Added
- Laravel 13 application at the repository root: MariaDB 11 via Laravel Sail
  (Docker), React 19 + Inertia 2 + TypeScript + Tailwind 4 frontend, Laravel React
  starter kit auth (Fortify, passkeys, 2FA), Pest 3 test suite, Pint, and Larastan.
  See ADR `0002-laravel-mariadb-stack`.
- `src/{domain,application,infrastructure}` wired into Composer PSR-4 autoloading.

### Changed
- Scaffold `README.md` moved to `docs/architecture/scaffold-overview.md`; root
  `README.md` now documents the Laravel stack.

- Dependency-free architectural scaffold: directory structure, per-directory `README.md`
  documentation, architecture docs, AI foundation (`.ai/`, `src/ai/`), source-control and
  project-management conventions, environment placeholders, `AGENTS.md`, and ADR
  `0001-dependency-free-scaffold`.
