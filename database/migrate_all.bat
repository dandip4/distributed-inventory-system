@echo off
echo Running migrations for master database...
php artisan migrate --database=master

echo Running migrations for location database...
php artisan migrate --database=location

echo Running migrations for transaction database...
php artisan migrate --database=transaction

echo All migrations completed!
