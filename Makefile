bash:
	docker exec -it proprli-app-1 bash;

migrate:
	docker exec  proprli-app-1 php artisan migrate;

seed:
	docker exec  proprli-app-1 php artisan db:seed;

composer:
	docker exec proprli-app-1 composer install;	
