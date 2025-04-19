#!/bin/bash

set -eux

cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

curl -sSLf -o /usr/local/bin/install-php-extensions https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions
chmod +x /usr/local/bin/install-php-extensions

install-php-extensions @composer xdebug

rm -rf /usr/local/bin/install-php-extensions
