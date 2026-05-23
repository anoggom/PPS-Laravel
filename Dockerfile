FROM php:8.4-cli-alpine

RUN apk add --no-cache bash sqlite-dev nodejs npm && docker-php-ext-install pdo pdo_mysql pdo_sqlite pcntl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-interaction --optimize-autoloader && npm ci && touch database/database.sqlite

EXPOSE 8000 5173

CMD ["composer", "run", "dev"]