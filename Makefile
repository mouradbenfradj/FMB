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
	@echo "  import-db     Import SQL dump into the 'oysterpro' database"
	@echo ""

# Target to install project dependencies using Composer and Yarn.
install: composer yarn-install yarn-dev
update: composer-update yarn-update yarn-dev
update-container: composer-update-container yarn-update-container yarn-dev-container

# Target to run Composer commands.
composer:
	composer $(filter-out $@,$(MAKECMDGOALS))
#	@docker-compose exec www composer $(filter-out $@,$(MAKECMDGOALS))
composer-update:
	@docker-compose exec www composer update
composer-update-container:
	composer update
composer-require:
	@docker-compose exec www composer require "dama/doctrine-test-bundle:^6" --dev
composer-require-container:
	composer require sonata-project/timeline-bundle

# Target to install dependencies with Yarn.
yarn-install:
	yarn install
#	@docker-compose exec www yarn install

# Target to update dependencies with Yarn.
yarn-update:
	@docker-compose exec www yarn upgrade

yarn-dev:
	yarn dev
#	@docker-compose exec www yarn dev
yarn-update-container:
	yarn upgrade

yarn-dev-container:
	yarn dev

yarn-add:
	@docker-compose exec www yarn add nestable2

# Target to import SQL dump into the 'oyster' database.
.PHONY: import-db-oyster
import-db-oyster:
	@docker cp migrations\admin_oysterpro_db.sql db_oysterpro:/tmp/admin_oysterpro_db.sql && \
	 docker-compose exec oyster bash -c "mysql -u root -pmourad oyster < /tmp/admin_oysterpro_db.sql"
.PHONY: import-db-oyster-container
import-db-oyster-container:
	php bin/console doctrine:migrations:migrate --no-interaction
# docker-compose exec oyster bash -c "mysql -u root -pmourad oyster < migrations/admin_oysterpro_db.sql"


create-db-and-migrate:
	@docker-compose exec www php bin/console doctrine:database:create --if-not-exists
	@docker-compose exec www php bin/console doctrine:database:create --if-not-exists --connection=oysterpro
	@docker-compose exec www php bin/console doctrine:database:create --if-not-exists --env=test
	@docker-compose exec www php bin/console doctrine:migrations:migrate --no-interaction
	@docker-compose exec www php bin/console doctrine:migrations:migrate -n --env=test
.PHONY: create-db-and-migrate

create-db-and-migrate-container:
	php bin/console doctrine:database:create --if-not-exists
	php bin/console doctrine:database:create --if-not-exists --connection=oysterpro
	php bin/console doctrine:database:create --if-not-exists --env=test
	php bin/console doctrine:migrations:migrate --no-interaction
	php bin/console doctrine:migrations:migrate -n --env=test
	php bin/console doctrine:migrations:migrate -n --no-interaction --em=oysterpro
.PHONY: create-db-and-migrate
delete-db:
	@docker-compose exec www php bin/console doctrine:database:drop --force
delete-db-container:
	php bin/console doctrine:database:drop --force 
	php bin/console doctrine:database:drop --force --connection=oysterpro

make-migration:
	@docker-compose exec www php bin/console make:migration 
make-migration-container:
	php bin/console doctrine:migrations:migrate --em=oysterpro  --write-sql --no-interaction
dsu:
	@docker-compose exec www php bin/console d:s:u -f 
dsu-container:
	php bin/console d:s:u -f 

load-fixtures:
	@docker-compose exec www php bin/console doctrine:fixtures:load --no-interaction

.PHONY: load-fixtures
cc:
	@docker-compose exec www php bin/console cache:clear --no-warmup
.PHONY: cc
cc-container:
	php bin/console cache:clear --no-warmup
.PHONY: cc-container
entity:
	@docker-compose exec www php bin/console make:entity Asc\Stock\StockArticle

.PHONY: entity
entity-container:
	php bin/console make:entity Asc\\FiliereComposite\\Segment

.PHONY: entity-container
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
teste-case:
	@docker-compose exec www php bin/console make:test TestCase Entity\\ParcTest
.PHONY: teste-case
web-teste-case:
	@docker-compose exec www php bin/console make:test WebTestCase  Service\\FiliereService
.PHONY: web-teste-case
kernel-teste-case:
	@docker-compose exec www php bin/console make:test KernelTestCase  Service\\FiliereService
.PHONY: kernel-teste-case