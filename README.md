# Nataalam.com
![CI](https://github.com/ybouhjira/nataalam-laravel/workflows/CI/badge.svg?branch=master)
## Install instructions

In production
```bash
composer install
npm install
gulp build
cp .env.example .env # edit it
php artisan migrate --force
php artisan nataalam:install
php artisan key:generate
cd public && ln --symbolic ../storage/app/public/ storage
```

In dev
```bash
composer install
npm install
cp .env.example .env # edit it
php artisan migrate --force
php artisan nataalam:install
php artisan db:seed --force

gulp # To watch the Sass and JS
```
