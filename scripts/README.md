# scripts/

## Purpose
Developer and operational helper scripts (setup, formatting, local checks, release
helpers).

## What belongs here
- Small, self-contained scripts using tools already assumed present (shell, the chosen
  language runtime)

## What does NOT belong here
- Application logic
- Secrets
- Anything that installs global dependencies without being obvious about it

## Example future files
- `scripts/check.sh`
- `scripts/setup.sh`

## Dependencies
None currently.
