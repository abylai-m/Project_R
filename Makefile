init: docker-down-clear \
	api-clear \
	docker-pull docker-build docker-up \
	api-init

up: docker-up
down: docker-down
restart: down up

docker-up:
	docker-compose up -d

docker-down:
	# --remove-orphans will delete all started containers with current root path prefix
	docker-compose down --remove-orphans

docker-down-clear:
	# -v - delete volumes
	docker-compose down -v --remove-orphans

# Update all images from registry
docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

api-clear:
	# we should run via sh -c cause of '*' mask usage
	docker run --rm -v ${PWD}/:/app -w /app alpine sh -c 'rm -rf var/*'

api-init: api-composer-install api-permissions

api-permissions:
	docker run --rm -v ${PWD}/:/app -w /app alpine chmod 777 var

api-composer-install:
	docker-compose run --rm php-cli composer install

api-composer-update:
	docker-compose run --rm php-cli composer update


build: build-api

build-api:
	docker --log-level=debug build --pull --file=docker/production/nginx/Dockerfile --tag=${REGISTRY}/auction-api:${IMAGE_TAG} api
	docker --log-level=debug build --pull --file=docker/production/php-fpm/Dockerfile --tag=${REGISTRY}/auction-php-fpm:${IMAGE_TAG} api
	docker --log-level=debug build --pull --file=docker/production/php-cli/Dockerfile --tag=${REGISTRY}/auction-php-cli:${IMAGE_TAG} api
