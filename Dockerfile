FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip zip curl && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

RUN composer install
