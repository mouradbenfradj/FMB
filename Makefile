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
install: composer yarn-install

# Target to run Composer commands.
composer:
	@docker-compose exec www composer $(filter-out $@,$(MAKECMDGOALS))

# Target to install dependencies with Yarn.
yarn-install:
	@docker-compose exec www yarn install

# Target to update dependencies with Yarn.
yarn-update:
	@docker-compose exec www yarn update

# Target to run Yarn development scripts.
yarn-dev:
	@docker-compose exec www yarn dev

# Target to import SQL dump into the 'oyster' database.
.PHONY: import-db-oyster
import-db-oyster:
	@docker cp migrations\admin_oysterpro_db.sql db_oyster:/tmp/admin_oysterpro_db.sql && \
	 docker-compose exec oyster bash -c "mysql -u root -pmourad oyster < /tmp/admin_oysterpro_db.sql"


create-db-and-migrate:
	@docker-compose exec www php bin/console doctrine:database:create --if-not-exists
	@docker-compose exec www php bin/console doctrine:database:create --if-not-exists --connection=oysterpro
	@docker-compose exec www php bin/console doctrine:migrations:migrate --no-interaction

make-migration:
	@docker-compose exec www php bin/console make:migration 

# Target to load fixtures using Doctrine Fixtures Bundle.
load-fixtures:
	@docker-compose exec www php bin/console doctrine:fixtures:load --no-interaction

# Ajoutez cette nouvelle cible à la liste des cibles disponibles.
.PHONY: load-fixtures
