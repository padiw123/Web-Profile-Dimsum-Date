FROM composer:2 as composer_stage
WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
# Menjalankan composer install. Tanda --ignore-platform-reqs penting di sini
# agar build tidak gagal hanya karena environment sementara ini belum punya ekstensi PHP.
RUN composer install --no-interaction --no-dev --prefer-dist --ignore-platform-reqs=ext-sockets --ignore-platform-reqs=ext-intl

# --- Tahap 2: Build aset Frontend dengan Node.js ---
FROM node:18-alpine as node_stage
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
# Menjalankan npm run build untuk mengkompilasi CSS/JS
RUN npm run build

# --- Tahap 3: Final - Gabungkan semuanya dengan PHP-CLI ---
# Kita gunakan image PHP-CLI (Command Line) karena servernya adalah RoadRunner, bukan Apache.
FROM php:8.3-cli

# Install dependency sistem & ekstensi PHP yang dibutuhkan Octane/RoadRunner/Filament
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    libicu-dev \
    libpq-dev \
    && docker-php-ext-install -j$(nproc) intl sockets pdo_pgsql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Siapkan direktori kerja
WORKDIR /var/www/html

# Salin file aplikasi dan hasil build dari tahap sebelumnya
COPY . .
COPY --from=composer_stage /app/vendor/ ./vendor/
COPY --from=node_stage /app/public/build/ ./public/build/

# Atur izin folder yang benar untuk storage dan cache Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Jalankan perintah optimasi Laravel untuk produksi
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Buka port 80 dan definisikan Start Command untuk menjalankan Octane
EXPOSE 80
CMD ["php", "artisan", "octane:start", "--host=0.0.0.0", "--port=80"]
