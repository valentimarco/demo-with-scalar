UID := $(shell id -u)
GID := $(shell id -g)
export UID
export GID 

build:
	docker compose build

up:
	docker compose up -d

down:
	docker compose down

bash:
	docker compose exec php bash

composer-install:
	docker compose exec php composer install

migrate:
	docker compose exec php bin/console do:da:dr --force  --if-exists -v
	docker compose exec php bin/console do:da:cr -v
	docker compose exec php bin/console do:mi:mi -v --no-interaction
	docker compose exec php bin/console do:mi:di -v
	docker compese exec php bin/console do:mi:mi -v

populate-db:
	docker compose exec php bin/console do:da:dr --force  --if-exists -v
	docker compose exec php bin/console do:da:cr -v --no-interaction
	docker compose exec php bin/console do:mi:mi -v --no-interaction
	docker compose exec php bin/console doctrine:fixtures:load -v --no-interaction

create-factory:
	docker compose exec php bin/console make:factory

create-story:
	docker compose exec php bin/console make:story
