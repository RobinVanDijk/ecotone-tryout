FROM php:8.2-fpm-alpine AS base

FROM base AS composer
USER www-data
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY ./composer.json ./composer.json
COPY ./composer.lock ./composer.lock

RUN composer install --no-scripts

FROM base AS cache
USER www-data
COPY --from=composer /var/www/html/vendor/ ./vendor/
COPY --from=composer /var/www/html/composer.lock ./composer.lock
COPY --from=composer /var/www/html/composer.json ./composer.json
COPY ./.env ./.env
COPY ./config/ ./config/
COPY ./src/ ./src/
COPY ./bin/ ./bin/
COPY ./symfony.lock ./symfony.lock

RUN ./bin/console cache:warmup

FROM base AS final
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev
RUN docker-php-ext-install pdo pdo_pgsql

COPY --from=cache /var/www/html/ ./
COPY ./public/index.php ./public/index.php