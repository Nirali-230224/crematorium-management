FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    && docker-php-ext-install gd zip pdo pdo_mysql
    
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan storage:link || true

EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port=8080