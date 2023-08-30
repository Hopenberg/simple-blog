# Simple blog

A simple blog with functionalities such as post adding/editing/removing, user adding/editing/removing and logging in/registering in.

## Installation instructions
- clone repository
- ```composer install```
- ```cp .env.example .env```
- ```php artisan key:generate```
- Set DB_DATABASE field in .env to absolute path to your database, f.e. ```C:/simple-blog/database/database.sqlite``` (I recommend using sqlite for its simplicity)
- ```php artisan migrate --seed```

php artisan symlink
