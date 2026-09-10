# src/config/

## Purpose
Loads and validates configuration for the application. Configuration *values* come from
the environment; this directory holds only the code that reads and shapes them.

## What belongs here
- Config schema / typed accessors
- Environment variable parsing and validation
- Defaults for non-sensitive settings

## What does NOT belong here
- Secret values (use environment / secret manager)
- Business logic
- Per-environment value files (see repo-root `config/`)

## Example future files
- `src/config/index.*`
- `src/config/schema.*`

## Dependencies that may eventually be introduced
A schema/validation library — via an ADR.
