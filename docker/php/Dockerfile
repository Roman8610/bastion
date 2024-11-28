# FROM php:8.3.10-apache-bullseye
# RUN apt-get update && apt-get install -y libgd-dev
# RUN docker-php-ext-install gd
# RUN apt-get install -y libzip-dev 
# RUN apt-get install libapache2-mod-ssl
# RUN docker-php-ext-configure zip
# RUN docker-php-ext-install zip
# RUN apt-get install -y libpq-dev 
# RUN docker-php-ext-install pdo pdo_mysql
# RUN curl -sS https://getcomposer.org/installer | php
# RUN mv composer.phar /usr/local/bin/composer
# RUN a2enmod rewrite
# RUN a2enmod ssl

FROM php:8.3.10-apache-bullseye

# Обновляем индекс пакетов и устанавливаем необходимые библиотеки
RUN apt-get update \
    && apt-get install -y libgd-dev libzip-dev libpq-dev \
    && apt-get install -y certbot

# Устанавливаем расширения PHP
RUN docker-php-ext-install gd zip pdo pdo_mysql

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Включаем нужные модули Apache
RUN a2enmod rewrite ssl

EXPOSE 80 443

#CMD ["service", "apache2", "restart"]
