ARG NGINX_IMAGE_TAG
FROM registry.dev.adoreme.com/base-images/nginx_fpm:${NGINX_IMAGE_TAG}
ADD . /var/www/
RUN chown www-data:www-data /var/www/ /var/www/bootstrap/cache && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
