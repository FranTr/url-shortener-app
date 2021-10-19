# url-shortener-app

## How to use
First of all, create vendor file with composer:
```bash
composer install
```
then, execute 
```bash
docker-compose build
```
and after that
```bash
docker-compose up
```
After having all the project up and running, it is needed to create the database
the database 
```bash
php bin/console doctrine:database:create
```
and execute the migration using doctrine
```bash
php bin/console doctrine:migrations:migrate
```

The app is running at localhost:8081 and it has 3 entrypoint

- "/urlshortened/create": This entrypoint allows you to create url shortened by POST method.
   Request example:
  ```json
  { "url": "http://www.google.com" }
  ```
- "/urlshortened/delete/{code}": Route used to soft delete a shortened url.
- "/urlshortened/redirect/{code}": Route used to redirect to the real url.

## testing

In order to execute all the tests, execute:
```bash
./vendor/bin/simple-phpunit tests
```