# Laravel Animals &middot; [![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/azdanov/laravel-animals/blob/master/LICENSE)

Building a small shop with an admin panel made with `Vue`. This is an `Hybrid app` with parts
made in plain `HTML` and others in `Vue` where SEO is not required.

| Main                                                                                                                      | User                                                                                                                               | Admin                                                                                                                                      |
| ------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------ |
| ![animals test_](https://user-images.githubusercontent.com/6123841/54782287-2df55880-4c27-11e9-8a94-c089876954c1.png)     | ![animals test_user_cart](https://user-images.githubusercontent.com/6123841/54782296-2fbf1c00-4c27-11e9-90e4-88d1b477e95c.png)     | ![animals test_admin_categories_cats](https://user-images.githubusercontent.com/6123841/54782290-2e8def00-4c27-11e9-9bca-52b5dc7faaed.png) |
| ![animals test_pets](https://user-images.githubusercontent.com/6123841/54782292-2e8def00-4c27-11e9-9cb0-c5bbc5e3525c.png) | ![animals test_user_cart (1)](https://user-images.githubusercontent.com/6123841/54782293-2e8def00-4c27-11e9-901b-763a3908d339.png) | ![animals test_admin_orders](https://user-images.githubusercontent.com/6123841/54783155-4fefda80-4c29-11e9-85b6-84bf6d010724.png)          |
|                                                                                                                           |

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

# set BRAINTREE_ENV=sandbox
# set BRAINTREE_PRIVATE_KEY=<key>
# set BRAINTREE_PUBLIC_KEY=<key>
# set BRAINTREE_MERCHANT_ID=<key>
# set DB_CONNECTION=sqlite
# set DB_HOST=127.0.0.1
# set DB_PORT=3306
# set DB_DATABASE="/Users/me/projects/animals/database/animals.sqlite"
# set DB_USERNAME=root
# set DB_PASSWORD=

touch database/animals.sqlite

php artisan key:generate
php artisan migrate
php artisan passport:install
php artisan db:seed

yarn
yarn dev
```

## Deployment on Heroku

The demo can be hosted on Heroku in such a way.

For this example the demo is named: `laravel-animals`.

1. Install [Heroku-CLI](https://devcenter.heroku.com/articles/heroku-cli)
2. Provision Heroku add-ons and build-packs:
    ```sh
    heroku apps:create laravel-animals
    heroku addons:create heroku-postgresql:hobby-dev --app laravel-animals
    heroku buildpacks:add heroku/php --app laravel-animals
    heroku buildpacks:add heroku/nodejs --app laravel-animals
    ```
3. Add Heroku to git remote:
    ```sh
    heroku git:remote --app laravel-animals
    ```
4. Set environmental variables on Heroku:
    ```sh
    heroku config:set --app laravel-animals APP_KEY=$(php artisan --no-ansi key:generate --show)
    heroku config:set --app laravel-animals APP_URL=$(heroku info -s | grep web_url | cut -d= -f2)
    heroku config:set --app laravel-animals MIX_APP_URL=$(heroku info -s | grep web_url | cut -d= -f2 | sed "s/\$/api/g")
    heroku config:set --app laravel-animals BRAINTREE_ENVIRONMENT=sandbox
    heroku config:set --app laravel-animals BRAINTREE_MERCHANT_ID=<id>
    heroku config:set --app laravel-animals BRAINTREE_PUBLIC_KEY=<key>
    heroku config:set --app laravel-animals BRAINTREE_PRIVATE_KEY=<key>
    ```
5. Deploy to Heroku
    ```sh
    git push heroku master
    ```
6. Run demo migrations and optimizations
    ```sh
    heroku run -a laravel-animals php artisan migrate
    heroku run -a laravel-animals php artisan db:seed
    heroku run -a laravel-animals php artisan config:cache
    heroku run -a laravel-animals php artisan route:cache
    ```
7. Enable debugging (Optional, be sure not to run this on production, and prune telescope entries regularly)
    ```sh
    heroku config:set --app laravel-animals APP_ENV=development APP_DEBUG=true APP_LOG_LEVEL=debug TELESCOPE_ENABLED=true
    ```

Any issues during deployment are usually because of wrong env variables for external services (redis, postgres, braintree, etc).


## License

[MIT](./LICENSE)
