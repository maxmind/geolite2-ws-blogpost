# Docker README

* [Getting Started](#getting-started)
* [Building Your Docker Container](#building-your-docker-container)
* [Running the Code](#running-the-code)
* [Refactoring Your Code](#refactoring-your-code)
  * [Mapping your local volume to the Docker container](#mapping-your-local-volume-to-the-docker-container)

## Getting Started

A `Dockerfile` has been provided in order to make this code more convenient to
run. To get started via `Docker`, you'll need:

* A working Docker environment
* A `git checkout` of this repository
* Your MaxMind Account ID and License Key

## Building Your Docker Container

After you have checked out this repository, run this command from the root
directory. (Replace `YOURACCOUNTID` with your MaxMind Account ID and
`YOURLICENSEKEY` with your License Key first. Linux users may need to preface
this command with `sudo`.)

```bash
docker build . -t geolite2-ws-blogpost --build-arg MM_ACCOUNT_ID=YOURACCOUNTID --build-arg MM_LICENSE_KEY=YOURLICENSE_KEY
```

This will build your Docker container.

## Running the Code

To start up your server, run this command. (Linux users may need to preface this
command with `sudo`.)

```bash
docker run -p 9595:9595 geolite2-ws-blogpost:latest
```

Now you can visit http://localhost:9595 on your host machine and make GeoLite2
Web Service queries.

## Refactoring Your Code

You can freely edit the code outside of the Docker container and then re-run it
from inside the container. To do so, you'll need to map your local volume to the
container and install the dependencies again as they won't exist in your local
volume. (Linux users may need to preface the Docker command with `sudo`.)

### Mapping your local volume to the Docker container
```bash
docker run -it -p 9595:9595 --volume $PWD:/project geolite2-ws-blogpost:latest /bin/bash
curl -sS https://getcomposer.org/installer | php
php composer.phar require geoip2/geoip2:~2.0
php -S 0:9595
```
