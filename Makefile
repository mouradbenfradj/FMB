# Makefile

# Define the default target when you run `make` without arguments.
.DEFAULT_GOAL := help

# Define a help target to display usage information.
help:
	@echo "Usage: make <target>"
	@echo "Targets:"
	@echo "  install       Install project dependencies using Composer and Yarn"
	@echo "  composer      Run Composer commands"
	@echo "  yarn-install  Install dependencies with Yarn"
	@echo "  yarn-update   Update dependencies with Yarn"
	@echo "  yarn-dev      Run Yarn development scripts"
	@echo "  import-db     Import SQL dump into the 'oyster' database"
	@echo ""

# Target to install project dependencies using Composer and Yarn.
install: composer yarn-install yarn-dev
update: composer-update yarn-update yarn-dev

# Target to run Composer commands.
composer:
	@docker-compose exec www composer $(filter-out $@,$(MAKECMDGOALS))
composer-update:
	@docker-compose exec www composer update
composer-require:
	@docker-compose exec www composer require "dama/doctrine-test-bundle:^6" --dev

# Target to install dependencies with Yarn.
yarn-install:
	@docker-compose exec www yarn install

# Target to update dependencies with Yarn.
yarn-update:
	@docker-compose exec www yarn upgrade

yarn-dev:
	@docker-compose exec www yarn dev

yarn-add:
	@docker-compose exec www yarn add nestable2

# Target to import SQL dump into the 'oyster' database.
.PHONY: import-db-oyster
import-db-oyster:
	@docker cp migrations\admin_oysterpro_db.sql db_oyster:/tmp/admin_oysterpro_db.sql && \
	 docker-compose exec oyster bash -c "mysql -u root -pmourad oyster < /tmp/admin_oysterpro_db.sql"


create-db-and-migrate:
	@docker-compose exec www php bin/console doctrine:database:create --if-not-exists
	@docker-compose exec www php bin/console doctrine:database:create --if-not-exists --connection=oysterpro
	@docker-compose exec www php bin/console doctrine:database:create --if-not-exists --env=test
	@docker-compose exec www php bin/console doctrine:migrations:migrate --no-interaction
	@docker-compose exec www php bin/console doctrine:migrations:migrate -n --env=test
delete-db:
	@docker-compose exec www php bin/console doctrine:database:drop --force

make-migration:
	@docker-compose exec www php bin/console make:migration 
dsu:
	@docker-compose exec www php bin/console d:s:u -f 

load-fixtures:
	@docker-compose exec www php bin/console doctrine:fixtures:load --no-interaction

.PHONY: load-fixtures
cc:
	@docker-compose exec www php bin/console cache:clear --no-warmup

.PHONY: cc
entity:
	@docker-compose exec www php bin/console make:entity

.PHONY: entity
controller:
	@docker-compose exec www php bin/console make:controller

.PHONY: controller
crud:
	@docker-compose exec www php bin/console make:crud

.PHONY: crud
regenerate-g-s:
	@docker-compose exec www php bin/console make:entity --regenerate

.PHONY: regenerate-g-s

tests:
	@docker-compose exec www php bin/console doctrine:database:drop --force --env=test || true
	@docker-compose exec www php bin/console doctrine:database:create --env=test
	@docker-compose exec www php bin/console doctrine:migrations:migrate -n --env=test
	@docker-compose exec www php bin/phpunit $@
.PHONY: tests