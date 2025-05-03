include .env
export

# Comandos principales
up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

restart:
	docker-compose down && docker-compose up -d --build

# Accesos rápidos a contenedores
bash:
	docker exec -it app bash

nginx:
	docker exec -it nginx sh

mysql:
	docker exec -it mysql mysql -u$(DB_USERNAME) -p$(DB_PASSWORD) $(DB_DATABASE)

mysql-root:
	docker exec -it mysql mysql -uroot -p$(DB_ROOT_PASSWORD)

# Artisan: php artisan <comando>
artisan:
	docker exec -it app php artisan $(cmd)

# Composer: composer <comando>
composer:
	docker exec -it app composer $(cmd)

# NPM: npm <comando>
npm:
	docker exec -it app npm $(cmd)

# Horizon
horizon:
	docker exec -it horizon php artisan horizon

# Utilidades
status:
	docker ps --format "table {{.ID}}\t{{.Names}}\t{{.Ports}}\t{{.Status}}"

