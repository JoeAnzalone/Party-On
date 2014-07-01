Party On!
=========

Event system that makes it easy to get RSVP's from people

Written using the [Laravel](http://laravel.com/) PHP framework

Installation
------------
1. Set up a MySQL database
2. Copy `app/config/local/database.php.sample` to `app/config/local/database.php`
3. Add your database details to `database.php`

Run these commands:

    composer install
    php artisan migrate
    php artisan tinker
    Sentry::createUser(['email' => 'user@example.com', 'password' => 'letmein', 'name' => 'Alice', 'activated' => true]);


License
-------
*Party On!* is open-sourced software licensed under the BSD 3-Clause license.
