# Development

Guides for humans and AI agents contributing to this repository.

- `coding-standards.md` — naming, structure, tooling, boundary rules
- `testing.md` — pytest layout and how services are handled in tests
- `services.md` — PostgreSQL, RabbitMQ, Redis, Celery processes, observability

## Setup
```
python -m venv .venv && source .venv/bin/activate
pip install -r requirements-dev.txt
pre-commit install
cp .env.example .env            # set SECRET_KEY
docker compose up --build       # db + rabbitmq + redis + web + worker + beat + flower
```

## Principles
- Prefer simple solutions over unnecessary abstraction.
- Respect layer boundaries (see `docs/architecture/`). Domain stays framework-free.
- Introduce a dependency only with an ADR that justifies it.
- Long/blocking work goes to Celery, not request handlers.
- Update documentation when the architecture changes.
