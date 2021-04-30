

## Local setup



- **[git clone https://github.com/Loydtafireyi/ecomm.git]**
- **[composer install]**
- **[npm install && npm run dev]**
- **[php artisan key:generate]**
- **[create .env file]**
- **[setup database]**
- **[php artisan migrate ]**
- **[php artisan passport:install]**
- **[Add the Client_ID 2 and CLIENT_SECRET to the env file and also add the OAuth URL - this is basically the app url plus /oauth/token eg http://localhost:8000/oauth/token]**
- **[php artisan db:seed]**
- **[php artisan storage:link]**
- **[php artisan serve]**



## Navigating

The admin dashboard creadentials admin@admin.com p/s password navigate to example.com/admin/login and start ading products.

At first i started working on the project using the tdd approach until when i ran out of time. 
Key areas to improve cover all the logic without test cases and extract duplicate methods into resuable methods or traits, cover ux validation and ui improvements.