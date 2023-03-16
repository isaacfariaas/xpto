# XPTO

## Getting Started 

### Rquirements

- Docker ^23.0.1
- Docker-Compose ^v2.16.0
- PHP 8.2

### Notes

### Setup environment

Copy default environment variables

```sh
$ cp .env.example .env
```
Docker compose up:

```sh
$ docker compose up -d --build
```
Composer Install:

```sh
$ docker compose exec laravel.test composer install
```
Docker compose down:

```sh
$ docker compose down -v
```

Sail alias:

```sh
$ alias sail=./vendor/bin/sail
```

Sail up:

```sh
$ sail up -d --build
```

Generate application Key:

```sh
$ sail artisan key:generate
```

Database migration:

```sh
$ sail artisan migrate:fresh --seed
```

### Admin Access

```sh
email: admin_sec@xpto.com.br
password: secXpto
```