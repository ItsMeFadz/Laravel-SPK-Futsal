FROM dunglas/frankenphp:1-php8.2

RUN apt-get update && apt-get install -y \
    git unzip curl \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install \
        pdo pdo_mysql mbstring zip exif pcntl bcmath gd

WORKDIR /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# copy source
COPY . .

# install dependency production only
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8000"]