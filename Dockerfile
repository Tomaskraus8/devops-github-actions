FROM php:8.4-cli-alpine

WORKDIR /app

COPY src/ src/
COPY composer.json composer.lock ./

RUN curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install --no-dev --prefer-dist --no-progress \
    && rm composer.phar

CMD ["php", "-a"]
