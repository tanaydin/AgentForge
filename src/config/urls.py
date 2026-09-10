"""Root URL configuration. Delegates to per-app URL modules under ``src/``."""
from django.urls import include, path

urlpatterns = [
    path("", include("src.api.urls")),
]
