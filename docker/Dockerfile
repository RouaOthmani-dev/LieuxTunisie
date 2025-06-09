# docker/Dockerfile
FROM php:8.1-fpm

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    zip unzip curl libpng-dev libjpeg-dev libonig-dev libxml2-dev libzip-dev git

# Extensions PHP nécessaires à Laravel
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier le projet (sera monté depuis l’hôte)
COPY . .

# Droits d’accès
RUN chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
