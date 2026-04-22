FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install Laravel dependencies (NOW GD exists)
RUN composer install --no-dev --optimize-autoloader

# Laravel setup
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan migrate --force \
 && php artisan storage:link

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080