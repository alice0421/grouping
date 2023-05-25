.PHONY: init
init:
	@rm -rf ./db
	@cp ./src/.env.example ./src/.env
	@docker-compose up -d
	@docker-compose exec app composer install
	@docker-compose exec app php artisan key:generate

.PHONY: up
up:
	@docker-compose up

.PHONY: down
down:
	@docker-compose down

.PHONY: stop
stop:
	@docker-compose stop

.PHONY: app
app:
	@docker-compose exec app bash
