# web/Dockerfile
FROM php:8.2-apache

# Instalar extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    libonig-dev \
    git \
    curl \
    iputils-ping \
    && docker-php-ext-install pdo_mysql gd mbstring

# Habilitar módulo de reescritura de Apache
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el archivo de configuración de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copiar el código fuente (usaremos un volumen en docker-compose.yml)
COPY . .

# Cambiar el propietario de todos los archivos en /var/www/html a www-data
RUN chown -R www-data:www-data /var/www/html

# Cambiar permisos para que www-data pueda leer y ejecutar los archivos
RUN chmod -R 755 /var/www/html

# Exponer el puerto 80
EXPOSE 80
