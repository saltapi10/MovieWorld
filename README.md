# MovieWorld

Installation of laravel with laravel installation suite
https://laravel.com/docs/11.x#creating-a-laravel-project

## Fetch laravel packages and Bring all containers up

Got o the project root path in terminal and run:

> docker-compose up -d

And then to fetch the core files

app_name : movieworld_app
> docker-compose exec [app_name] bash

> composer install

And then again build all containers and run

> docker-compose build

> docker-compose up -d

Generate a Laravel App Key.
> php artisan key:generate


Run the database migrations.
>php artisan migrate

## Watching assets for changes

Install all npm packages included in package.json

>npm install

Build the css,js files from vite.config.com
>npm run build

Compile css,js on save for development. (Optional)
>npm run watch
