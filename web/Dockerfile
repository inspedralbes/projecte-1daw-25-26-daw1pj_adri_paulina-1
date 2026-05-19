# Imatge base: PHP 8.2 amb Apache
FROM php:8.2-apache
# Exposem el port 80. No fa falta xk ho fem al yml (ports: - 8080:80)
EXPOSE 80 

# Instal·lar l'extensió mysqli per connectar amb MySQL
RUN docker-php-ext-install mysqli

# Habilitar visualització d'errors (només per desenvolupament)
# Modifiquem el fitxer de configuració del PHP que estarà dins de la imatge
# per tal que mostri més informació dels errors quan desenvolupem
RUN echo "display_errors = On" >> /usr/local/etc/php/php.ini-development && \
    echo "error_reporting = E_ALL" >> /usr/local/etc/php/php.ini-development && \
    cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini


#Instal·lem les extensions de PHP que necessitem
RUN docker-php-ext-install pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Instal·lem dependències
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    unzip \
    git\
    apt-transport-https\
    ca-certificates\
    wget\
    lsb-release \
    gnupg2

RUN apt-get clean

# Instal·lem l'extensió MongoDB per PHP
RUN pecl install mongodb \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini \
    && docker-php-ext-enable mongodb

# 2. (Opcional) comprovem que l’extensió s’ha carregat
RUN php -m | grep mongodb

# Instal·lem Composer
COPY --from=composer/composer:2.8.8-bin /composer /usr/bin/composer

# Configurem el directori de treball
WORKDIR /var/www/html

#### NO HO FEM PQ. després montem el volum i taparia la carpeta vendor que es crees
### en aquest punt. Seria perdre el temps, perque després ho tornem a fer al docker-compose
#Copiem composer.json per instal·lar les dependències
#COPY composer.json -> command: /bin/bash...
#RUN composer install --no-interaction --no-plugins --no-scripts

# Permisos al directori web
RUN chown -R www-data:www-data /var/www/html

# Exposem el port 80
EXPOSE 80