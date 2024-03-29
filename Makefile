META_FOLDER=.castor
MAIN_SERVICE_NAME=lib

setup: prepare boot

# Prepares the project to be initialized
prepare: build dependencies

# Builds docker images needed for this project from scratch
build:
	docker-compose build --no-cache --pull

# Installs dependencies with composer
dependencies:
	docker-compose run --rm $(MAIN_SERVICE_NAME) composer install

# Boots all the services in the docker-compose stack
boot:
	docker-compose up -d --remove-orphans

# Formats the code according to php-cs-fixer rules
fmt:
	docker-compose exec $(MAIN_SERVICE_NAME) vendor/bin/php-cs-fixer fix

# Run static analysis on the code
analyze:
	docker-compose exec $(MAIN_SERVICE_NAME) vendor/bin/psalm --stats --no-cache --show-info=true

# Runs the test suite
test:
	docker-compose exec $(MAIN_SERVICE_NAME) vendor/bin/phpunit --coverage-text

# Stops all services and destroys all the containers.
# NOTE: Named kill to convey the more accurate meaning that the containers are destroyed.
kill:
	docker-compose down

# Stops the services. Use this when you are done with development for a while.
stop:
	docker-compose stop

# Prepares a PR
pr: fmt analyze test