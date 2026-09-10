# src/api/

## Purpose
Delivery layer, implemented with **Django**. Exposes the application over HTTP: URL
routing, views, request/response serialization, middleware wiring. Views stay thin and
call into `src/application/`.

## What belongs here
- `urls.py`, `views.py`, serializers/forms
- DRF viewsets/serializers if Django REST Framework is later adopted (via ADR)
- Auth/permission wiring

## What does NOT belong here
- Business rules (`src/domain/`)
- Use-case orchestration (`src/application/`)
- ORM models and queries (`src/infrastructure/`)

## Example future files
- `src/api/views.py`
- `src/api/serializers.py`

## Dependencies
Django (chosen — see ADR 0002). Django REST Framework would require a new ADR.
