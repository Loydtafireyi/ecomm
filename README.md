

## Local setup



- **[git clone https://github.com/Loydtafireyi/ecomm.git]**
- **[composer install]**
- **[npm install && npm run dev]**
- **[php artisan key:generate]**
- **[create .env file]**
- **[setup database]**
- **[php artisan migrate ]**
- **[php artisan passport:install]**
- **[Add the Client_ID 2 and CLIENT_SECRET to the env file and also add the OAuth URL - this is basically the app url plus /oauth/token eg http://ecommtest.test/oauth/token]**
- **[php artisan db:seed]**
- **[php artisan storage:link]**
- **[visit your test development url]** 

#### NB. You will need some sort of server to run this app eg xampp, valet, laragon. php artisan serve command will not work since it uses a PHP server which is single-threaded. [single-threaded.](https://www.php.net/manual/en/features.commandline.webserver.php)



## Navigating

The admin dashboard creadentials admin@admin.com p/s password navigate to example.com/admin/login and start ading products.

At first i started working on the project using the tdd approach until when i ran out of time. 
Key areas to improve cover all the logic without test cases and extract duplicate methods into resuable methods or traits, cover ux validation and ui improvements.