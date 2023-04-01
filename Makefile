# Define variables
DOCKER_COMPOSE = docker-compose
DOCKER_EXEC = $(DOCKER_COMPOSE) exec fmb
PHP_EXEC = $(DOCKER_EXEC) php
COMPOSER_EXEC = $(PHP_EXEC) composer
ARTISAN_EXEC = $(PHP_EXEC) php artisan

# Define targets
.PHONY: install
install:
	$(DOCKER_COMPOSE) build
	$(DOCKER_COMPOSE) up -d
	$(COMPOSER_EXEC) install
	$(ARTISAN_EXEC) migrate
	$(ARTISAN_EXEC) db:seed

.PHONY: start
start:
	$(DOCKER_COMPOSE) up -d

.PHONY: stop
stop:
	$(DOCKER_COMPOSE) down

.PHONY: restart
restart:
	$(DOCKER_COMPOSE) down
	$(DOCKER_COMPOSE) up -d

.PHONY: composer-install
composer-install:
	$(COMPOSER_EXEC) install

.PHONY: artisan-migrate
artisan-migrate:
	$(ARTISAN_EXEC) migrate

.PHONY: artisan-seed
artisan-seed:
	$(ARTISAN_EXEC) db:seed

.PHONY: shell
shell:
	$(DOCKER_EXEC) bash
