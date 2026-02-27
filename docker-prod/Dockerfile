FROM dunglas/frankenphp:1-php8.2

RUN apt-get update && apt-get install -y \
    git unzip curl iproute2 iputils-ping netcat-openbsd \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install \
        pdo pdo_mysql mbstring zip exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# COPY SEMUA SOURCE DULU (PENTING)
COPY . .

# BARU install dependency
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Permission
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8000"]