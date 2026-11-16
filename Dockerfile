FROM php:8.3-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends unzip libsqlite3-dev libzip-dev \
    && docker-php-ext-install pdo_sqlite zip bcmath \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && cp .env.example .env \
    && sed -i 's/^APP_ENV=local/APP_ENV=production/' .env \
    && sed -i 's/^APP_DEBUG=true/APP_DEBUG=false/' .env \
    && php artisan key:generate --force \
    && chmod -R 775 storage bootstrap/cache

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 10000
CMD ["docker-entrypoint.sh"]
