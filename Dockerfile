FROM dunglas/frankenphp

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN install-php-extensions \
    pdo_pgsql pgsql zip pcntl

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8080

CMD ["frankenphp", "php-server", "-r", "/app/public", "--listen", "0.0.0.0:8080"]