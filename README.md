# Laravel Animals &middot; [![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/azdanov/laravel-animals/blob/master/LICENSE)

Building a small store with an admin panel made with Vue.

![Laravel Animals Screenshot](https://user-images.githubusercontent.com/6123841/54487258-8f6e9d80-489c-11e9-9536-9e616a7d0344.png "Laravel Animals Screenshot")

## Getting started

Use [Homestead](https://laravel.com/docs/5.7/homestead)
or [Valet](https://github.com/laravel/valet).

### Dependencies

-   [PHP >= 7.3.*](https://laravel.com/docs/5.7#server-requirements)
-   [Sqlite](https://www.sqlite.org/index.html)
-   [Node](https://nodejs.org/en/)

### Services

These services are required for using the payment functionality in this demo.

-   [Braintree](https://www.braintreepayments.com/) - [Sandbox version](https://www.braintreepayments.com/sandbox)

### Installing

[Composer](https://getcomposer.org/) and [Yarn](https://yarnpkg.com/en/) are required to install and bundle the dependencies.

```sh
composer install

cp .env.example .env

# set DB_DATABASE to an absolute path e.g DB_DATABASE="/Users/me/projects/animals/database/animals.sqlite"

touch database/animals.sqlite

php artisan key:generate
php artisan migrate
php artisan passport:install
php artisan db:seed

yarn
yarn dev
```

## License

[MIT](./LICENSE)
