# Utiliser l'image officielle PHP avec PHP-FPM 8.3
FROM php:8.3-fpm

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    git \
    unzip \
    zip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl mbstring xml opcache

    RUN php -m

# Installer Composer globalement dans un répertoire non monté
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer Symfony CLI globalement
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le code source de l'application dans le conteneur
COPY . .

# Installer les dépendances PHP avec Composer
RUN composer install --no-scripts --no-interaction --optimize-autoloader

# Changer les permissions pour le répertoire de travail
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Lancer PHP-FPM
CMD ["php-fpm"]