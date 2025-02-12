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

CHART
chartjs

PDF
spatie browsershot

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

for ui design
https://flowbite.com/docs/components/card/
and tailwind

//composer require barryvdh/laravel-dompdf
reference... https://www.positronx.io/how-to-generate-pdf-in-laravel-with-dompdf/#tc_10431_02

after cloning the project
-- rename .env.example to .env
-- run php artisan key:generate
-- run composer install
-- run npm install
-- run npm run dev
-- in .env change the database credentials
-- execute php artisan migrate

To create a new model and migratioon together
php artisan make:model Category -m
-- where -m means create the migration file
-- Model name should be propercase and singular

if a table already exist and you want to add extra columns
then you cannot use the same way as make:model instead we use
php artisan make:migration name_of_the_migration --table=tablename
eg
php artisan make:migration add_column_image_url_to_table_categories --table=categories
TO create a controller
php artisan make:controller CategoryController

We can do validation using form request. TO create a form request
php artisan make:request CreateCategoryRequest

// to store images in the app, we can use storage/app folder.
//to use this storage we need to create a symbolic link in the public folder. we do that by the following command
php artisan storage:link

the form must have

<form  
  enctype="multipart/form-data" to upload image

TO SEND EMAIL, WE WILL TRY MAILHOG
download mailhog from https://mailhog.io/download/ and install it
in you .env file

MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025

to start the mailhog server
mailhog
to view the email
http://127.0.0.1:8025

To create the email we use the following command
php artisan make:mail SendWelcomeEmail
