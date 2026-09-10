"""Celery task wrappers.

Tasks are a delivery/adapter concern: keep them **thin**. A task should deserialize its
arguments, call a use case in ``src/application``, and return a serializable result.
Business logic does not live here.
"""
from __future__ import annotations

from celery import shared_task


@shared_task(bind=True, max_retries=3, default_retry_delay=10)
def example_task(self, payload: dict) -> dict:
    """Placeholder. Replace with a real task that calls an application use case."""
    return {"received": payload}
