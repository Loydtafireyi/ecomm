

## Local setup


```php 
    git clone https://github.com/Loydtafireyi/ecomm.git] 
```
⋅⋅* cd into the  project ecomm
```php 
composer install
```
```php 
run npm install && npm run dev 
```
```php 
php artisan key:generate
```
⋅⋅* create .env file
⋅⋅*For Windows run ```copy .env.example .env```  For Mac and Linux run ```cp .env.example .env```
⋅⋅* Setup Your Database either sqlite of mysql
```php 
php artisan migrate 
```
```php 
 php artisan passport:install
 ```
⋅⋅* Add the Client_ID 2 and CLIENT_SECRET to the env file and also add the OAuth URL - this is basically the app url plus /oauth/token eg http://ecommtest.test/oauth/token
```php 
 php artisan db:seed
 ```
```php 
run php artisan storage:link
```
⋅⋅*  visit your test development url

#### NB. You will need some sort of server to run this app eg xampp, valet, laragon. php artisan serve command will not work since it uses a PHP server which is [single-threaded.](https://www.php.net/manual/en/features.commandline.webserver.php)



## Navigating

The admin dashboard credentials admin@admin.com p/s password navigate to example.com/admin/login and start ading products.

At first i started working on the project using the tdd approach until when i ran out of time. 
Key areas to improve cover all the logic without test cases and extract duplicate methods into resuable methods or traits, cover ux validation and ui improvements.