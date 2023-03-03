PHP_BASH = docker exec -it ssau-php

setup:
	cp .env.example .env
	docker-compose up -d --build
	${PHP_BASH} composer install
	${PHP_BASH} chmod -R 777 storage/
	${PHP_BASH} php artisan key:generate
	${PHP_BASH} php artisan migrate
