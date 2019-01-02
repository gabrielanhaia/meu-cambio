[![Build Status - travis-ci](https://travis-ci.org/gabrielanhaia/meu-cambio.svg?branch=master)](https://travis-ci.org/gabrielanhaia/meu-cambio)

# Meu Câmbio

Notes on updating the feed: A database structure has been created that can be viewed in the `database` (image) folder. This structure saves all the publications (every hour of the last execution), however, I saved it as a manual task (Item 7) using the laravel command.

## Login and how to use the API:

In addition to this documentation, you can import my postman collection with the [https://www.getpostman.com/collections/0f3de4c8c196ddfd5747](https://www.getpostman.com/collections/0f3de4c8c196ddfd5747] link,
or you can just import using Swagger 2.0 (`api_v1.yml`) using your favorite http client.

Default user inserted by Laravel Seed:
email: **test@meucambio.com.br**
password: **root**

## Installation:

1. Clone the project:
```
git clone https://github.com/gabrielanhaia/meu-cambio.git
```

2. Make a copy of `.env.example` to `.env` in the source path of your project.

3. Set the following variables:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=meu_cambio
DB_USERNAME=root
DB_PASSWORD=123123
```

4. Open your favorite MySql Client and connect to DB, after that, create a database in the
 `DB_DATABASE` (item 3).

5. Open the terminal and go to the source path, execute the following commands:
```
php composer.phar install # If you already have the composer: composer install
php artisan key:generate
php artisan jwt:secret
```

6. Run the `Migrations` and `Seeders` to update your database:
```
php artisan migrate
php artisan db:seed
```

7. Run to get the Globo Feed and update your database with the informations:
```
php artisan update_feed:globo
```

8. Run the web server (PHP Build-in com o Artisan):
```
php artisan serve
```
 
9. Test the API and Have fun!

## Running the tests (PHPUnit)
Open the project (Terminal) and run:
```
php vendor/bin/phpunit 
```
