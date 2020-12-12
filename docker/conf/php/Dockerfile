FROM php:7.4-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev \
 wget \
 gnupg2 \
    && docker-php-ext-install pdo_mysql

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN pear config-set php_ini /usr/local/etc/php/php.ini \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=false" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=nicks-pc" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /var/www

# Install composer
COPY install_composer.sh /root/
COPY composer /usr/local/bin/

RUN chmod 755 /root/install_composer.sh && mkdir /var/www/storage && mkdir /var/www/storage/logs && /root/install_composer.sh

RUN chmod 755 /usr/local/bin/composer && chmod 755 /usr/local/etc/php/composer.phar

RUN mkdir /opt/phpstorm-coverage && chmod 755 /opt/phpstorm-coverage
