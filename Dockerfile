FROM leandreaci/php:8.0
COPY . .
RUN composer install
