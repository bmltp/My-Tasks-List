# My Tasks List

Application to manage tasks which is designed for personal or home use. It is built with Laravel Backend, (Passport)RESTful API, Bootstrap, ReactJS etc.

Muti-user with authenticated API and web
to note tasks.

## Requirements

* PHP 7.2 or higher
* Composer
* NPM
* Database(Sqlite, Mysql, PostgreSQL)
* Web Server
* Other libraries

### Installation

* Install PHP >= 7.2 : installation may vary depending on operating system.
* Install <a href='https://getcomposer.org/download/'>Composer</a> and <a href='https://nodejs.org/en/download/'>NPM</a>.
* Download Zip or clone repository.
```
git clone https://github.com/bmltp/My-Tasks-List.git
```
* Enter to project
```
cd My-Task-List
```
* Copy .env.example to .env and modify depending on your needs.
```
cp .env.example .env
```
* To use sqlite: Open .env file and change the section:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
* To:
```
DB_CONNECTION=sqlite
```
* And make a file database.sqlite in the folder database within the root directly of this project.
For example: (For GNU/Linux and Mac) from root directory of the project run:
```
touch database/database.sqlite
```
* Run these command on terminal:
```
composer install
npm install
```
* Migrate the database:
```
php artisan migrate
```
* Initialise some users and Tasks run:
```
php artisan db:seed
```
(Email: user1@mail.com, Password: password)
* Generate keys:
```
php artisan key:generate
php artisan passport:install
php artisan passport:client --personal
```
Example: personal access client [Laravel Personal Access Client]:>
 > MyApp

* Run all Mix tasks:
```
npm run dev
```
* Run PHP server:
```
php artisan serve
```
* Open http://localhost:8000

* To stop server:
```
Ctrl+c
```
* Access within local network run:
```
php artisan serve --host=0.0.0.0
```
* Open http://IP-of-host:8000 to browse.
* After changes in files:
```
npm run dev && php artisan serve
```

## Tips

If you face any issue then try to <a href="https://github.com/dessant/clear-browsing-data">Clear Browsing Data</a> or restart server and web browser.
```
Ctrl+c
npm run dev && php artisan serve
```
## Security Issues

* HTTP only
* React Frontend saves API token in local storage
* This project is only to practice and learn.


## Author

* **<a href="https://github.com/bmltp">Bimal Thapa**</a> - (https://github.com/bmltp)

## License

This project is released under the GPLv3 License.
