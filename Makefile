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
	docker exec -it app-store bash

nginx:
	docker exec -it server-store sh

mysql:
	docker exec -it db-store mysql -u$(DB_USERNAME) -p$(DB_PASSWORD) $(DB_DATABASE)

mysql-root:
	docker exec -it db-store mysql -uroot -p$(DB_ROOT_PASSWORD)

# Artisan: php artisan <comando>
artisan:
	docker exec -it app-store php artisan $(cmd)

# Composer: composer <comando>
composer:
	docker exec -it app-store composer $(cmd)

# NPM: npm <comando>
npm:
	docker exec -it app-store npm $(cmd)

# Horizon
horizon:
	docker exec -it horizon php artisan horizon

# Utilidades
status:
	docker ps --filter "name=Proyecto-Polleria" --format "table {{.ID}}\t{{.Names}}\t{{.Ports}}\t{{.Status}}"

