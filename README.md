
# Star

the backend side of the star application (Api)


## Tech Stack

**Server:** php, Laravel


## Run Locally

Clone the project

```bash
  git clone https://github.com/3neef/Astar-task.git
```

Go to the project directory

```bash
  cd Astar-task
```

- Rename `.env.example` file to `.env`inside your project root and fill the database information.
  (windows wont let you do it, so you have to open your console cd your project root directory and run `copy .env.example .env` )
- Open the `.env` and configuer your database 
- Run `composer install` or ```php composer.phar install```
- Run `php artisan key:generate` 
- Run `php artisan migrate`
- Run `php artisan db:seed` to run the seeder and get the admin credentials.
- Run `php artisan serve`

Username & password : 
```bash
  name: star
  password : password
```

to get Swagger doc run :
```bash
  composer require darkaonline/l5-swagger

  php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

  php artisan l5-swagger:generate

  php artisan optimize
``` 
then go to the docs ur to find the endpoints :
```bash
  http://localhost:8000/api/documentation
```
 ### Reminders

 - admins can do all the CRUD operations , users can only Read.
 - only admins can create another user and can make it user or admin, users can't create users.
 
### Author

- [@Mazin](https://www.github.com/3neef)

