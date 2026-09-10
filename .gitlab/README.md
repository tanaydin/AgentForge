# .gitlab/

## Purpose
Placeholder for GitLab-specific configuration (merge request templates, issue templates,
CI include files) if the project is hosted on or mirrored to GitLab.

## What belongs here
- `merge_request_templates/*.md`
- `issue_templates/*.md`
- CI fragments included by a future `.gitlab-ci.yml`

## What does NOT belong here
- Secrets or deploy tokens
- Actual pipeline implementation (add `.gitlab-ci.yml` at repo root when CI is introduced)

## Notes
No GitLab integration is configured yet. The repository is source-control-host neutral.
