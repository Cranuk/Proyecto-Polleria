FROM php:8.2-fpm

# Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    zip unzip curl git libpng-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo_mysql gd bcmath intl

# Instalar Node.js y npm
RUN apt-get install -y nodejs npm

# Definir el directorio de trabajo
WORKDIR /var/www
