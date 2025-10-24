FROM php:8.2-fpm

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libsodium-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install \
    intl \
    sodium \
    zip \
    pdo \
    pdo_mysql \
    mysqli \
    && rm -rf /var/lib/apt/lists/*

# Configuration du répertoire de travail
WORKDIR /var/www/html

# Copie des fichiers de l'application
COPY . .

# Installation des dépendances Composer (si composer.lock existe)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN if [ -f "composer.lock" ]; then composer install --no-dev --optimize-autoloader; else composer install; fi

# Configuration des permissions
RUN chown -R www-data:www-data /var/www/html

# Exposition du port 9000 pour PHP-FPM
EXPOSE 9000