<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setting Application For the first time
- open cmd and cd to folder where you want to install application 
- git clone https://github.com/ardysanka/lalravel-test.git
- cd to project(cd lalravel-test)
- run command "composer install" without "
- rename file .env.example to .env
- run command "php artisan key:generate" without "
- make sure you have empty database with database name salt or you can change DB_DATABASE={your_database_name} in .env file
- run command "php artisan migrate"  without "
- run command "php artisan serve"  without "
- open new cmd and cd to project
- run command "php artisan queue:work"   without "
