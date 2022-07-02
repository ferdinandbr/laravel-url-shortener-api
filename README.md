# Laravel URL Shortener API

![License](https://img.shields.io/badge/license-MIT-green) ![PHP](https://img.shields.io/badge/php-7.4-blue) ![Laravel](https://img.shields.io/badge/laravel-8-red)

Simple api to create short urls

## Features
- Creating custom urls
- Expiration date setting (max 3 days)
- Job to delete expired urls (hourly)

## Installation

Clone repo and install dependencies

```sh
git clone https://github.com/ferdinandbr/laravel-url-shortener-api.git
cd laravel-url-shortener-api
composer install
```

Copy .env and generate key:

```sh
cp .env.example .env
php artisan key:generate
```

Setup DB credentials:
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:
```sh
php artisan migrate
```

Run tests:
```sh
php artisan test
```

Start server and run commands:

```sh
php artisan serve
php artisan schedule:work
```

## Routes

| Route | Method |
| ------ | ------ |
| /api/newShortUrl | POST |
| /api/redirect | GET |

## Route Parameters

/api/newShortUrl
| Parameter | Required | Allowed |
| ------ | ------ | ------ |
| url | yes | url |
| expiration | no | int (max 3) 
| customUrlName |no | string |

/api/redirect
| Parameter | Required | Allowed |
| ------ | ------ | ------ |
| identifier | yes | string |

## License

MIT


