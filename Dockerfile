FROM php:8.0-fpm

RUN apt-get update && apt-get install zip unzip -y

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /app/estation-backend

COPY . .

RUN composer install
