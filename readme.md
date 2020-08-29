# UMS Laravel / Vue App
> A simple User Management System
> Laravel API that uses the API resources with a Vue.js frontend

## Quick Start

``` bash
# Install Dependencies
composer install

# Install JS Dependencies
npm install

# Configure environment
    - copy / rename .env.example to .env
    - Create a blank DB and setup DB privileges on MySql server
    - Put DB user and password into `.env` file  

# Run Migrations
php artisan migrate

# Import Articles
php artisan db:seed

# Create the encryption keys needed to generate secure access tokens
php artisan passport:install

# If you get an error about an encryption key
php artisan key:generate

# Run applications on the PHP development server
php artisan serve
```

* To make phpunit test, run: 
$ ./vendor/bin/phpunit --verbose

### Version

1.0.0

### License

This project is licensed under the MIT License

