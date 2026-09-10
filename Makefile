.PHONY: help install up down migrate makemigrations run worker beat shell test lint fmt check

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN{FS=":.*?## "}{printf "  %-14s %s\n", $$1, $$2}'

install:  ## Install dev dependencies + pre-commit
	pip install -r requirements-dev.txt && pre-commit install

up:  ## Start all services (db, rabbitmq, redis, web, worker, beat, flower)
	docker compose up --build

down:  ## Stop and remove containers
	docker compose down

migrate:  ## Apply migrations
	python manage.py migrate

makemigrations:  ## Create migrations
	python manage.py makemigrations

run:  ## Run the dev server
	python manage.py runserver

worker:  ## Run a Celery worker
	celery -A src.config worker -l info

beat:  ## Run the Celery beat scheduler
	celery -A src.config beat -l info

test:  ## Run tests
	pytest

lint:  ## Lint
	ruff check . && mypy src

fmt:  ## Format
	ruff format . && black .

check:  ## Django system checks
	python manage.py check --deploy
