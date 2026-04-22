FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    && docker-php-ext-install gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Laravel setup (IMPORTANT: remove migrate for now)
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan storage:link
 && php artisan migrate --force \


EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080