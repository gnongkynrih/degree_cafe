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
