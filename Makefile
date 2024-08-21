bash:
	docker exec -it proprli-app bash;

migrate:
	docker exec  proprli-app php artisan migrate && docker exec proprli-app php artisan db:seed;

seed:
	docker exec proprli-app php artisan db:seed;

composer:
	docker compose up app -d && docker exec proprli-app composer install && docker compose down;

up:	
	docker compose up -d;

build:
	docker compose build;

down:
	docker compose down;

test:
	docker exec  proprli-app vendor/bin/phpunit;
