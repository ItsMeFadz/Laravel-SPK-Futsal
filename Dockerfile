FROM dunglas/frankenphp:1-php8.2

RUN apt-get update && apt-get install -y \
    git unzip curl \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install \
        pdo pdo_mysql mbstring zip exif pcntl bcmath gd

WORKDIR /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# copy composer dulu (penting)
COPY composer.json composer.lock ./

# install dependency termasuk octane
RUN composer require laravel/octane \
    && composer install --no-dev --optimize-autoloader

# copy seluruh source
COPY . .

# env dummy untuk build-time artisan
RUN cp .env.example .env \
    && php artisan key:generate \
    && php artisan octane:install --server=frankenphp

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8000", "--watch"]
