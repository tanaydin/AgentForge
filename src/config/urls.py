"""Root URL configuration."""
from django.contrib import admin
from django.urls import include, path

urlpatterns = [
    path("admin/", admin.site.urls),
    path("api/", include("src.api.urls")),
    path("health/", include("health_check.urls")),
    path("", include("django_prometheus.urls")),  # /metrics
]
