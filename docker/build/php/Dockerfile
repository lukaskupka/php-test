FROM php:8.2-apache

ENV TZ=Europe/Prague

RUN apt-get update && \
    apt-get install -y \
      libicu-dev \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install mysqli pdo pdo_mysql intl gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === file_get_contents('https://composer.github.io/installer.sig')) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); exit(1); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN a2enmod rewrite

RUN { \
  echo 'post_max_size = 64M'; \
  echo 'upload_max_filesize = 32M'; \
  echo 'memory_limit = 256M'; \
  echo 'max_file_uploads = 100'; \
} > /usr/local/etc/php/conf.d/uploads.ini

RUN echo $TZ > /etc/timezone

RUN mkdir -p /home/www-data/

ARG uid
ARG gid

RUN echo "UID: $uid, GID: $gid" \
  && groupmod -g $gid www-data \
  && usermod -u $uid www-data

RUN chown -R www-data:www-data /home/www-data
RUN usermod -d "/home/www-data" -s "/bin/bash" www-data

RUN mkdir -p /opt/composer \
  &&chown -R $uid:$gid /opt/composer

USER $uid:$gid
