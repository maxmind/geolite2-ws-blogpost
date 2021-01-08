# Docker README

* [Getting Started](#getting-started)
* [Building Your Docker Container](#building-your-docker-container)
* [Logging in to Your VM](#logging-in-to-your-vm)
* [Running the Code](#running-the-code)
* [Refactoring Your Code](#refactoring-your-code)
  * [Mapping your local volume to the Docker container](#mapping-your-local-volume-to-the-docker-container)

## Getting Started

A `Dockerfile` has been provided in order to make this code more convenient to
run. To get started via `Docker`, you'll need:

* A working Docker environment
* A `git checkout` of this repository

## Building Your Docker Container

After you have checked out this repository, run this command from the root
directory. (Replace `YOURACCOUNTID` with your MaxMind Account ID and
`YOURLICENSEKEY` with your License Key first. Linux users may need to preface
this command with `sudo`.)

```bash
docker build . -t geolite2-ws-blogpost --build-arg MM_ACCOUNT_ID=YOURACCOUNTID --build-arg MM_LICENSE_KEY=YOURLICENSE_KEY
```

This will build your Docker container.

## Logging in to Your VM

To log in to your container, run this command. (Linux users may need to preface
this command with `sudo`.)

```bash
docker run -it -p 9595:9595 geolite2-ws-blogpost:latest /bin/bash
```

## Running the Code

Once you have logged in, you can run the server:

```bash
php -S 0:9595
```

Now you can visit http://localhost:9595 on your host machine and make GeoLite2
Web Service queries.

## Refactoring Your Code

You can freely edit the code outside of the Docker container and then re-run it
from inside the container. To do so, you'll need to map your local volume to the
container and install the dependencies again as they won't exist in your local
volume. (Linux users may need to preface this command with `sudo`.)

### Mapping your local volume to the Docker container
```bash
docker run -it -p 9595:9595 --volume $PWD:/project geolite2-ws-blogpost:latest /bin/bash
curl -sS https://getcomposer.org/installer | php && \
    php composer.phar require geoip2/geoip2:~2.0 && \
    sed -i "s/MM_ACCOUNT_ID/${MM_ACCOUNT_ID}/g" index.php && \
    sed -i "s/MM_LICENSE_KEY/${MM_LICENSE_KEY}/g" index.php
php -S 0:9595
```
