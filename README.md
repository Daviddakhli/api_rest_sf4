# Rest Api Symfony Application

The purpose of this project is to provide a standard REST JSON-API that would allow a mobile application or a full frontend website to display a mini site.

> This project uses [Swagger](https://swagger.io/) for the API documentation.

# Installation 
* clone the project : `git@github.com:kdakhli/api_rest_sf4.git`

* inside the project folder run : `composer install`

* setup your database by changing this line in `.env` file `DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name`

* connect the db by running the following command at the root of the project : `php bin/console doctrine:database:create`

* run this command in order to create the database schema : `php bin/console doctrine:schema:create`

* now since the database is ready , we can add some data fixtures : `php bin/console doctrine:fixtures:load`

* just start the build-in symfony server to begin exploring the api : `php bin/console server:start` then go to http://localhost:8000 to use the API Sandbox

====> Enjoy :) 
