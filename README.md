# Wordpress Kickstart

## Index

- [Intro](#intro)
- [Stack](#stack)
- [Getting Started](#getting-started)

## [Intro](#intro)

Este documento contém todas as informações necessárias para a inicialização do ambiente de desenvolvimento do projeto Puranatus.

## Stack(#stack)

- [PHP](https://www.php.net)
- [MariaDB](https://mariadb.org)
- [Nginx](https://www.nginx.com)
- [Docker](https://www.docker.com)
- [Let's Encrypt](https://letsencrypt.org)
- [Gulp](https://gulpjs.com)

### [Getting Started](#getting-started)

**First use**

1. Execute `cp .env_exmaple .env` to create the `.env` dotfile from `.env_example` and set the environment for this project.

**Start the project**

1. Execute `bash ./start` to create docker containers and volumes.
2. Open the browser at [http://127.0.0.1](http://127.0.0.1)
3. Profit!

**Stop the project**

1. Execute `bash ./stop` to stop all Dcoker services and remove containers and others relateds files.
2. Profit!
