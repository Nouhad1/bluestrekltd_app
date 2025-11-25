# Utiliser PHP 8.2 avec Apache
FROM php:8.2-apache

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip git libonig-dev libxml2-dev libpng-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Activer le module Apache rewrite
RUN a2enmod rewrite

# Copier l'application
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Générer la clé d'application Laravel
RUN php artisan key:generate

# Permissions sur storage et bootstrap/cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Exposer le port 80
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]
