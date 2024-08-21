bash:
	docker exec -it proprli-app-1 bash;

migrate:
	docker exec  proprli-app-1 php artisan migrate && docker exec proprli-app-1 php artisan db:seed;

seed:
	docker exec proprli-app-1 php artisan db:seed;

composer:
	docker compose up app -d && docker exec proprli-app-1 composer install && docker compose down;

up:	
	docker compose up -d;

build:
	docker compose build;

down:
	docker compose down;

test:
	docker exec  proprli-app-1 vendor/bin/phpunit;
