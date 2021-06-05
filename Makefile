help:
	@echo "/--- Conversional --------------------------------------------------/";
	@echo "setup    	Setup the application"
	@echo "up		Create and start containers"
	@echo "destroy		Stop and remove containers"
	@echo "status 		Shows the status of the containers"
	@echo "shell		Starting a shell in php container"
	@echo "root		Starting a shell in php container (sudo privileges)"
	@echo "phpunit         Run phpunit tests"
	@echo "/-----------------------------------------------------------------/";

setup:
	docker-compose up --build -d
	docker-compose exec --user=application php composer install
	docker-compose exec --user=application php php bin/console doctrine:migrations:migrate --env=test
	docker-compose exec --user=application php php bin/console doctrine:migrations:migrate
	docker-compose exec --user=application php php bin/console doctrine:fixtures:load

up:
	docker-compose up -d

destroy:
	docker-compose down

status:
	docker-compose ps

shell:
	docker-compose exec --user=application php sh

root:
	docker-compose exec php sh

phpunit:
	docker-compose exec --user=application php ./vendor/bin/phpunit