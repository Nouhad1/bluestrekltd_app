# -----------------------------
# 1) PHP + Composer
# -----------------------------
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    zip unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# -----------------------------
# 2) Nginx configuration
# -----------------------------
COPY ./deploy/nginx.conf /etc/nginx/sites-enabled/default

# -----------------------------
# 3) Start PHP + Nginx
# -----------------------------
CMD service nginx start && php-fpm
