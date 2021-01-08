FROM php:8

ARG MM_ACCOUNT_ID
ENV MM_ACCOUNT_ID=$MM_ACCOUNT_ID
ARG MM_LICENSE_KEY
ENV MM_LICENSE_KEY=$MM_LICENSE_KEY

RUN if [ "${MM_ACCOUNT_ID}" = "" ] ; then echo "The MM_ACCOUNT_ID build-arg must be provided"; false; fi
RUN if [ "${MM_LICENSE_KEY}" = "" ] ; then echo "The MM_LICENSE_KEY build-arg must be provided"; false; fi

EXPOSE 9595

COPY index.php /project/

WORKDIR /project

RUN apt-get update && \
    apt-get install -y unzip && \
    curl -sS https://getcomposer.org/installer | php && \
    php composer.phar require geoip2/geoip2:~2.0
