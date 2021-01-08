FROM php:8

ARG MM_ACCOUNT_ID
ENV MM_ACCOUNT_ID=$MM_ACCOUNT_ID
ARG MM_LICENSE_KEY
ENV MM_LICENSE_KEY=$MM_LICENSE_KEY

EXPOSE 9595

COPY index.php /project/

WORKDIR /project

RUN apt update && \
    apt install -y unzip && \
    curl -sS https://getcomposer.org/installer | php && \
    php composer.phar require geoip2/geoip2:~2.0 && \
    sed -i "s/MM_ACCOUNT_ID/${MM_ACCOUNT_ID}/" index.php && \
    sed -i "s/MM_LICENSE_KEY/${MM_LICENSE_KEY}/" index.php
