
# Laravel REST API using JWT and TDD 

Laravel REST API using JWT and TDD Starter. Based on my tutorial https://muhammadtriwibowo.medium.com/laravel-rest-api-with-jwt-and-tdd-dc5c84067658


## Installation

- Clone this Project
- Install dependencies using composer

```bash
    composer install
```

- Copy .env.example to .env, edit your databasa config

```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=<your_db_name>
    DB_USERNAME=<your_db_username>
    DB_PASSWORD=<your_db_password>
```
- Generate app key
```bash
  php artisan key:generate
```

- Generate JWT Key

```bash
 php artisan jwt:secret
```
- Migrate database tables

```bash
 php artisan migrate
```
Run the app
```bash
 php artisan serve
```
## Creating Test
Just run command below (for example you want make test for Product)

```bash
php artisan make:test ProductTest
```
## Running Testing
Just run command below

```bash
php artisan test
```