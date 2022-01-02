FROM php:8.0.10-apache

RUN a2enmod rewrite
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install gettext

RUN apt-get update && apt-get install -y git unzip zip 
RUN apt-get install -y cron
RUN apt-get update && apt-get install -y cron wget nano mcrypt
RUN apt-get install libmcrypt-dev
RUN pecl install mcrypt-1.0.4 && docker-php-ext-enable mcrypt
#RUN apt-get upgrade openssl -y
 
 
#RUN a2enmod rewrite
#RUN a2enmod ssl
#RUN a2enmod headers
 


RUN docker-php-ext-install pdo pdo_mysql  
WORKDIR /var/www/html

RUN chown -R root:root /etc/cron.d/
RUN chmod 0644 /etc/cron.d/
USER root

COPY ./docker/server/crontab /etc/cron.d/

 RUN /etc/init.d/cron restart



# Apply cron job
RUN crontab /etc/cron.d/crontab


# Run the command on container startup
#CMD crontab && tail -f /var/www/html/cron.log
 
#CMD /etc/init.d/cron restart
#ENTRYPOINT [ "cron", "-f" ]
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd pdo_mysql bcmath zip intl opcache

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer
 
EXPOSE ${APP_PORT}
EXPOSE 443
 