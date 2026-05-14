FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libzip-dev zip nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN chown -R www-data:www-data storage bootstrap/cache

RUN a2enmod rewrite
RUN a2dismod mpm_worker
RUN a2dismod mpm_event
RUN a2enmod mpm_prefork
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 8080

RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]