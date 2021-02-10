# API EGRESADOS LARAVEL 8
Laravel Authentication Scaffold using Laravel Fortify and Bootstrap.

## How To Use This?

Download or clone this repo
```shell
$ git clone https://github.com/DrkDsk/apiV8_egresados
```

Install all dependency required by Laravel.
```shell
$ composer install
```

Generate app key, configure `.env` file and do migration.
```shell
# create copy of .env
$ cp .env.example .env

# create Laravel key
$ php artisan key:generate

# run migration
$ php artisan migrate
```
