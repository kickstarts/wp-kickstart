# Wordpress Kickstart

## Index

- [Introdução](#intro)
- [Requerimentos](#stack)
- [Iniciando](#getting-started)

## [Introdução](#intro)

Este documento contém todas as informações necessárias para a inicialização do ambiente de desenvolvimento do projeto Puranatus.

## Requerimentos(#stack)

- [PHP](https://www.php.net)
- [MariaDB](https://mariadb.org)
- [Nginx](https://www.nginx.com)
- [Docker](https://www.docker.com)
- [Let's Encrypt](https://letsencrypt.org)
- [Gulp](https://gulpjs.com)

### [Iniciando](#getting-started)

**Primeiro uso**

1. Execute `cp .env.example .env` para criar um arquivo`.env` a partir do arquivo `.env.example` e defina as variáveis de ambiente para o seu projeto.

**Iniciando o container**

1. Execute `bash ./start` para criar os containers e volumes.
2. Abra o seu navegador preferido no endereço: [http://127.0.0.1](http://127.0.0.1)
3. Feito!

**Finalizando o container**

1. Execute `bash ./stop` para finalizar os containers do Docker.
2. Feito!
