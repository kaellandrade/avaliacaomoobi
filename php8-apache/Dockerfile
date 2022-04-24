FROM php:8-apache-buster
RUN docker-php-ext-install pdo pdo_mysql bcmath opcache
RUN docker-php-ext-install mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
# Packges para utilizar o composer
RUN apt-get update
RUN apt-get install -y zlib1g-dev libzip-dev unzip
RUN docker-php-ext-install zip
#Abiliantando o .htacces
RUN cd /etc/apache2/mods-enabled && a2enmod rewrite