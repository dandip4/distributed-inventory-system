@echo off
echo Migrate Fresh All Databases...

echo Migrating Master Database...
php artisan migrate:fresh --database=master --path=database/migrations/master

echo Migrating Location Database...
php artisan migrate:fresh --database=location --path=database/migrations/location

echo Migrating Transaction Database...
php artisan migrate:fresh --database=transaction --path=database/migrations/transaction

echo Running Additional Migrations...
php artisan migrate --database=master

echo Seeding All Databases...
php artisan db:seed

echo Migration and Seeding completed!
pause
