## Albums and Songs Manager
<p>A Laravel application for managing albums and songs.</p> 

<p>The admin user can create, edit as well as delete albums; assign song to the album and any other 
admin operation on the song. Songs are as well grouped by genres, which can then we used 
on the admin dashboard as filtering</p>

### Tech stack and app foundation

- PHP 8.2.3
- Laravel 10
- Breeze
- VueJs 3
- Inertia
- MySQL
- Docker

### How to run the app

1. Make sure the system has the correct PHP version (8.2.3) in our case and composer installed
2. Clone the project from https://github.com/ElijahBus/albums-songs-manager.git 
3. `cd` in the project root folder and run `composer install` to have all dependencies installed in the application
4. Create a `.env` file in the root folder and copy in it everything from `.env.example`
5. Configure properly the following keys in the `.env` file:
   ````
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ````
6. In case you have docker on your system, run `docker-compose up` from the root folder of the application,
it will run a MySQL container on port `3306` that you can use. otherwise just install MySQL and configure it following the instruction on your operating system.
7. Once MySQL is installed and the connection is well established, create the database with the name give for `DB_DATABASE` in your `.env` file, then run `php artisan migrate` to have all tables created.
8. Once successful, run `php artisan db:seed --class=GenreSeeder` to have the song genres seeded.
9. Boom you're good, run `php artisan serve` , visit your app on the running port, register an account, and have fun 🎉

### Bonus

If you decide to play around with the codes, don't worry, the `tests` have got you covered, you can run `php artisan test` at any time to make sure nothing broke.
