FROM composer:2 as composer_stage
WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev --prefer-dist --ignore-platform-reqs

FROM node:18-alpine as node_stage
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    libicu-dev \
    libpq-dev \
    && docker-php-ext-install -j$(nproc) intl sockets pdo_pgsql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY . .
COPY --from=composer_stage /app/vendor/ ./vendor/
COPY --from=node_stage /app/public/build/ ./public/build/

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 80
CMD ["php", "artisan", "octane:start", "--host=0.0.0.0", "--port=80"]
