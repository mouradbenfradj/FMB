FROM php:7.4-apache

# Configuration de l'Apache
RUN echo "ServerName asc" >> /etc/apache2/apache2.conf

# Installation des dépendances
RUN apt-get update \
    && apt-get install -y --no-install-recommends locales apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configuration des locales
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

# Configuration de PHP
COPY php.ini /usr/local/etc/php/conf.d/custom-php.ini

# Redémarrer Apache
RUN service apache2 restart

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installation de Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony*/bin/symfony /usr/local/bin/symfony


# Install Node.js
# Installation de Node.js et Yarn
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g yarn

# Configuration des extensions PHP
RUN docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_mysql gd opcache intl zip calendar dom mbstring zip gd xsl \
    && pecl install apcu \
    && docker-php-ext-enable apcu

# Définir le répertoire de travail
WORKDIR /var/www/asc
