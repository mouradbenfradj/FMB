.DEFAULT_GOAL := help

SYMFONY_BIN = symfony
YARN = yarn

COMPOSER = $(SYMFONY_BIN) composer
PHPUNIT = $(SYMFONY_BIN) php bin/phpunit
SYMFONY = $(SYMFONY_BIN) console


##
## Database
.PHONY: db db-reset db-cache db-validate fixtures

db: vendor db-reset fixtures ## Reset database and load fixtures

db-cache: vendor ## Clear doctrine database cache
	@$(SYMFONY) doctrine:cache:clear-metadata
	@$(SYMFONY) doctrine:cache:clear-query
	@$(SYMFONY) doctrine:cache:clear-result
	@echo "Cleared doctrine cache"

db-reset: vendor ## Reset database
	@-$(SYMFONY) doctrine:database:drop --if-exists --force
	@-$(SYMFONY) doctrine:database:create --if-not-exists
	@$(SYMFONY) doctrine:schema:update --force

db-validate: vendor ## Checks doctrine's mapping configurations are valid
	@$(SYMFONY) doctrine:schema:validate --skip-sync -vvv --no-interaction

fixtures: vendor ## Load fixtures - requires database with tables
	@$(SYMFONY) doctrine:fixtures:load --no-interaction


##
## Linting
.PHONY: lint lint-container lint-twig lint-xliff lint-yaml

lint: vendor ## Run all lint commands
	make -j lint-container lint-twig lint-xliff lint-yaml

lint-container: vendor ## Checks the services defined in the container
	@$(SYMFONY) lint:container

lint-twig: vendor ## Check twig syntax in /templates folder (prod environment)
	@$(SYMFONY) lint:twig templates -e prod

lint-xliff: vendor ## Check xliff syntax in /translations folder
	@$(SYMFONY) lint:xliff translations

lint-yaml: vendor ## Check yaml syntax in /config and /translations folders
	@$(SYMFONY) lint:yaml config translations


##
## Node.js
.PHONY: assets build watch

yarn.lock: package.json
	@$(YARN) upgrade

node_modules: #yarn.lock ## Install node packages
	@$(YARN) install

assets: node_modules ## Run Webpack Encore to compile development assets
	@$(YARN) dev

build: node_modules ## Run Webpack Encore to compile production assets
	@$(YARN) build

watch: node_modules ## Recompile assets automatically when files change
	@$(YARN) watch


##
## PHP
composer.lock: composer.json
	@$(COMPOSER) update

vendor: composer.lock ## Install dependencies in /vendor folder
	@$(COMPOSER) install --no-progress


##
## Project
.PHONY: install update cache-clear cache-warmup ci clean purge reset start

install: db assets ## Install project dependencies

update: vendor node_modules ## Update project dependencies
	@$(COMPOSER) update
	@$(YARN) upgrade

cache-clear: vendor ## Clear cache for current environment
	@$(SYMFONY) cache:clear --no-warmup

cache-warmup: vendor cache-clear ## Clear and warm up cache for current environment
	@$(SYMFONY) cache:warmup

ci: db-validate lint security tests ## Continuous integration

clean: purge ## Delete all dependencies
	@rm -rf var vendor node_modules public/build
	@echo "Var, vendor, node_modules and public/build folders have been deleted !"

purge: ## Purge cache and logs
	@rm -rf var/cache/* var/log/*
	@echo "Cache and logs have been deleted !"

reset: unserve clean install ## Reset project

start: install serve ## Install project dependencies and launch symfony web server


##
## Symfony binary
.PHONY: serve unserve security

serve: ## Run symfony web server in the background
	@$(SYMFONY_BIN) serve --daemon --no-tls

unserve: ## Stop symfony web server
	@$(SYMFONY_BIN) server:stop

security: vendor ## Check packages vulnerabilities (using composer.lock)
	@$(SYMFONY_BIN) check:security


##
## Tests
.PHONY: tests

tests: vendor ## Run tests
	@$(PHPUNIT)


##
## Help
.PHONY: help

help: ## List of all commands
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'