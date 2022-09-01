FROM 802949940722.dkr.ecr.eu-west-3.amazonaws.com/ubuntu-laravel:latest

COPY . /var/www/html

RUN cd /var/www/html \
    && chown www-data:www-data . --recursive \
    && composer install \
    && npm install \
    && gulp build \
    && cp .env.prod.example .env \
    && php artisan key:generate \
    && php artisan config:cache \
    && rm -f /etc/apache2/sites-available/000-default.conf \
    && rm -rf node_modules

COPY server-config/000-default.conf /etc/apache2/sites-available/
RUN a2enmod rewrite


EXPOSE 80

CMD cd /var/www/html && php artisan migrate --force && apachectl -D FOREGROUND
