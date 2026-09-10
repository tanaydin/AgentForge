# Releases

- Versioning: Semantic Versioning (`MAJOR.MINOR.PATCH`) once the project ships.
- `CHANGELOG.md` at repo root follows "Keep a Changelog" style.
- A release = a tagged commit on `main` plus a changelog entry.
- Release checklist (once CI exists): `manage.py migrate --check`, `manage.py test`,
  `manage.py collectstatic` all green.
- Release automation (CI) is not configured yet.
