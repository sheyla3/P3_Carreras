# Usa una imagen base que tenga PHP 8.2 con Apache
FROM php:8.2-apache

# Configuración de entorno
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Instala dependencias necesarias para la extensión GD y otras extensiones de PHP
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        git \
        unzip \
        libzip-dev \
        libmagickwand-dev \
        --no-install-recommends

# Configura y instala la extensión GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

# Configura y instala otras extensiones de PHP
RUN docker-php-ext-install zip pdo pdo_mysql

# Instala y habilita la extensión imagick
RUN pecl install imagick && \
    docker-php-ext-enable imagick

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el contenido del proyecto al contenedor
COPY . /var/www/html

# Establece la variable de entorno para permitir ejecutar composer como root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Instala dependencias de PHP con Composer
RUN composer install --no-scripts --no-autoloader && \
    composer dump-autoload --optimize

# Configura permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Actualiza la configuración de Apache
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Habilita módulos de Apache necesarios
RUN a2enmod rewrite

# Expone el puerto 80 para el contenedor
EXPOSE 80

# Inicia Apache en el contenedor
CMD ["apache2-foreground"]
