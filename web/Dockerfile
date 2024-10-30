FROM php:8.2-apache
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    iputils-ping \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /var/www/html
COPY . .
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
# RUN php artisan migrate
# RUN php artisan storage:link \
#    php artisan migrate:fresh --seed
EXPOSE 80