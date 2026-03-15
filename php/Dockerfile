FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    libicu-dev \
    libmagickwand-dev \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Install Node.js 18.x
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Install Yarn
RUN npm install -g yarn

# PHP Extensions

# Zip
RUN docker-php-ext-configure zip && docker-php-ext-install zip

# Calendar
RUN docker-php-ext-install calendar

# Imagick
RUN pecl install imagick && docker-php-ext-enable imagick

# GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Intl
RUN docker-php-ext-configure intl && docker-php-ext-install intl

# PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# OPCache
RUN docker-php-ext-install opcache

# APCu
RUN pecl install apcu && docker-php-ext-enable apcu

# Enable Apache modules
RUN a2enmod rewrite headers expires

# Set working directory
WORKDIR /var/www/asc

# Copy vhosts configuration
COPY vhosts/asc.conf /etc/apache2/sites-available/asc.conf
RUN a2ensite asc.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/asc \
    && chmod -R 755 /var/www/asc

CMD ["apache2-foreground"]

