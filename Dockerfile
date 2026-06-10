FROM php:8.4-cli-alpine

WORKDIR /app

COPY composer.json composer.lock phpunit.xml ./
COPY src/ src/
COPY tests/ tests/
COPY bin/ bin/

RUN curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install --prefer-dist --no-progress \
    && php vendor/bin/phpunit \
    && php composer.phar install --no-dev --prefer-dist --no-progress \
    && rm -rf composer.phar tests/ phpunit.xml

ENTRYPOINT ["php", "bin/calculator.php"]
CMD ["add", "2", "3"]
