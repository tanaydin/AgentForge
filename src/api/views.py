"""Delivery-layer views. Keep these thin: parse input, call the application layer,
serialize output. Business rules live in ``src/domain``; orchestration in
``src/application``.
"""
from django.http import HttpRequest, JsonResponse


def health(_request: HttpRequest) -> JsonResponse:
    """Liveness probe. No dependencies on domain or infrastructure."""
    return JsonResponse({"status": "ok"})
