# Definimos variables
DOCKER_COMPOSE = cd docker && docker compose
DOCKER = cd && docker

# Inicializar el entorno
init:
	$(DOCKER_COMPOSE) up -d --build
	@echo "Installing dependencies..."
	$(DOCKER_COMPOSE) exec app composer install
	@echo "Environment ready!"

# Apagar los contenedores
stop:
	$(DOCKER_COMPOSE) down

# Reiniciar el entorno
restart:
	$(DOCKER_COMPOSE) down -v
	$(DOCKER_COMPOSE) up -d

# Acceder a la terminal del contenedor PHP
shell:
	$(DOCKER) exec -it php_app bash

# Acceder a MySQL dentro del contenedor
mysql:
	$(DOCKER_COMPOSE) exec mysql mysql -uuser -ppassword user_db


.PHONY: test unit integration

test:
	cd docker && docker compose exec app vendor/bin/phpunit --bootstrap tests/bootstrap.php

unit:
	cd docker && docker compose exec app vendor/bin/phpunit --testsuite Unit

integration:
	cd docker && docker compose exec app vendor/bin/phpunit --testsuite Integration
