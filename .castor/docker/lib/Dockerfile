FROM alpine:3.16 as base

ARG UID=1000
ARG COMPOSER_VERSION=2.3.0
ARG USER=castor

# Create a development user
RUN adduser $USER --disabled-password --home /$USER --uid $UID

# Install PHP Extensions
RUN apk add --no-cache \
    php81-cli \
    php81-phar \
    php81-mbstring \
    php81-json \
    php81-zip \
    php81-openssl \
    php81-dom \
    php81-xml \
    php81-soap \
    php81-session \
    php81-xmlwriter \
    php81-sockets \
    php81-simplexml \
    php81-bcmath \
    php81-xmlreader \
    php81-tokenizer \
    php81-iconv \
    php81-sodium \
    php81-fileinfo \
    php81-curl \
    php81-ctype \
    php81-pcntl \
    php81-posix \
    php81-pdo \
    php81-pdo_mysql \
    php81-pdo_sqlite \
    php81-pdo_pgsql

# Link PHP
RUN ln -s /usr/bin/php81 /usr/bin/php

# Add wget to make requests
RUN apk add --no-cache wget

# Download and install composer
RUN wget -O /usr/bin/composer https://github.com/composer/composer/releases/download/$COMPOSER_VERSION/composer.phar && \
    chmod +x /usr/bin/composer

FROM base as dev

# Install and Configure XDebug
RUN apk add --no-cache php81-pecl-xdebug
COPY ./lib/xdebug.ini /etc/php81/conf.d/60_xdebug.ini

CMD ["tail", "-f", "/dev/null"]