FROM php:8.0.13-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

RUN apt-get update && apt-get install -y --allow-unauthenticated \
    --no-install-recommends build-essential  openssl nginx libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev  \
    libzip-dev gcc g++ make vim unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev \
    gnupg \
    libcurl4-openssl-dev \
    libzip-dev \
    git \
    libpng-dev \
    sendmail \
    libgconf-2-4 libatk1.0-0 libatk-bridge2.0-0 libgdk-pixbuf2.0-0 libgtk-3-0 libgbm-dev libnss3-dev libxss-dev \
    libasound2 \

    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install tokenizer \
    && docker-php-ext-install curl \
    && docker-php-ext-install gd \
    && docker-php-ext-install exif \
    && docker-php-ext-install zip;

RUN apt-get update && apt-get install -y \
    php-pear \
    php-dev; \

    cd ~ \
    && curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer;

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Root passwd
RUN echo "root:root" | chpasswd

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
