FROM php:8.4-cli-alpine

RUN apk add --no-cache bash sqlite-dev && docker-php-ext-install pdo pdo_mysql pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-interaction --optimize-autoloader

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]