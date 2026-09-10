"""HTTP routes for the API delivery layer.

Views here only translate HTTP <-> application calls. No business rules.
"""
from django.urls import path

from src.api import views

urlpatterns = [
    path("health/", views.health, name="health"),
]
