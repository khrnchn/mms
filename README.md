# mosque management system

![Mosque Management System GIF](public/images/mms.gif)

## introduction
the mosque management system is a web app built using filamentphp. it provides a comprehensive solution for managing various aspects of a mosque, including events, committees, forums, notifications, programs, and news.

## installation
clone the project and
`composer install`

then `cp .env.example .env` and update your .env file (db, app name, etc). after that,

```
php artisan key:gen
php artisan migrate
```

and `php artisan make:filament-user` to create your first user. after that, start browsing your app's landing page or login into the dashboard.