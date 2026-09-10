"""Ensure the Celery app is loaded when Django starts so ``@shared_task`` works."""
from src.config.celery import app as celery_app

__all__ = ("celery_app",)
