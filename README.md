# Simple blog

A simple blog with functionalities such as post adding/editing/removing, user adding/editing/removing and logging in/registering in.

## Installation instructions
- clone repository
- ```composer install``` (needs to be run on command line with unix interface, such as Git Bash, because of post install commands)
- Set DB_DATABASE field in .env to absolute path to your database, f.e. ```C:/simple-blog/database/database.sqlite``` (I recommend using sqlite for its simplicity)
- ```php artisan migrate --seed```
- To ensure email password reset service is working I recommend using MailHog
- ```php artisan serve```
- Default user is login: ```admin@simpleblog.com``` password: ```admin123```

