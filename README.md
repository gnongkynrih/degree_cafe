Roles and Permissions
https://spatie.be/docs/laravel-permission/v6/installation-laravel
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
//add HasRoles Trait in your User model inside App/Models/User.php
Use HasRoles;

//create new roles and permission
//to create new roles and permisison we will use seeder
php artisan make:seeder RoleAndPermissionSeeder
//TO seed the seeder
php artisan db:seed --class=RoleAndPermissionSeeder

//to user factory to create new records
php artisan make:factory MenuFactory
//for Menu model to use MenuFactory in the Menu.php file we
have to write use HasFactory;

razorpay

composer require razorpay/razorpay
https://razorpay.com/docs/payments/server-integration/php/install/#prerequisites

Add Below Details For Trial :

Visa Card No : 4111111111111111

Mobile No : 1231231231

OTP No : **\***
razorpay_payment_id

pdf
npm install puppeteer
composer require spatie/browsershot

//composer require barryvdh/laravel-dompdf
reference... https://www.positronx.io/how-to-generate-pdf-in-laravel-with-dompdf/#tc_10431_02

after cloning the project
-- run composer install
-- run npm install
-- run npm run dev
-- execute php artisan migrate

To create a new model and migratioon together
php artisan make:model Category -m
-- where -m means create the migration file
-- Model name should be propercase and singular

TO create a controller
php artisan make:controller CategoryController

We can do validation using form request. TO create a form request
php artisan make:request CreateCategoryRequest
//create a symbolic link
php artisan storage:link
