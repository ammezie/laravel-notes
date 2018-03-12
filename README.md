# laravel-notes

A collaborative note app built with Laravel, Vue.js and Pusher. Follow the tutorial [https://pusher.com/tutorials/collaborative-note-app-laravel/](https://pusher.com/tutorials/collaborative-note-app-laravel/)

## Getting Started

Clone the project repository by running the command below if you use SSH

```
git clone git@github.com:ammezie/laravel-notes.git
```

If you use https, use this instead

```
git clone https://github.com/ammezie/laravel-notes.git
```

After cloning, run:

```
composer install
```

Duplicate `.env.example` and rename it `.env`

Then run:

```
php artisan key:generate
```

### Prerequisites

#### Setup Pusher

If you don't have one already, create a free Pusher account at https://pusher.com/signup then login to your dashboard and create an app. 

Set the `BROADCAST_DRIVER` in your `.env` file to **pusher**:

```
BROADCAST_DRIVER=pusher
```

Then fill in your Pusher app credentials in your `.env` file:

```
PUSHER_APP_ID=xxxxxx
PUSHER_APP_KEY=xxxxxxxxxxxxxxxxxxxx
PUSHER_APP_SECRET=xxxxxxxxxxxxxxxxxxxx
```

Also, remember to fill in the `cluster` of your Pusher app and other additional options in `config/broadcasting.php`:

```
// config/broadcasting.php

'options' => [
   'cluster' => 'eu',
   'encrypted' => true
],
```

#### Database Migrations

Be sure to fill in your database details in your `.env` file before running the migrations:

```
php artisan migrate
```

And finally, start the application:

```
php artisan serve
```

and visit [http://localhost:8000/](http://localhost:8000/) to see the application in action.

## Built With

* [Pusher](https://pusher.com/) - APIs to enable devs building realtime features
* [Laravel](https://laravel.com) - The PHP Framework For Web Artisans
* [Vue.js](https://vuejs.org) - The Progressive JavaScript Framework
