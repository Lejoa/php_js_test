PHP & JS Test
============================

* Small app in PHP/Symfony that has one table/entity `products` with the following fields: `id`, `name`, `description`, and `price`
* Default sample products into the DB
* RESTful endpoints to Create, Read, Update, Delete
* Logical Delete, not physical
* Small JavaScript app that lists the products and allows the user to delete them

Requirements
============

- Docker `>= 18.x`
- Docker Compose `>= 1.24.x`

Stack
=====

- PHP 7.1.33
- Composer
- Git
- Bower
- SQLite
- AngularJS v1.7.9

Setup
=====
- Build the containers with:

```sh
$ docker-compose up -d
```

- Install PHP depencencies with:

```sh
$ docker-compose exec php composer install 
```

- Install Javascript depencencies with:

```sh
$ docker-compose exec -w /usr/src/app/public php bower install --allow-root
```

- Update database schema:

```sh
$ docker-compose exec php ./bin/console doctrine:schema:update --force
```

- Load database fixtures:

```sh
$ docker-compose exec php ./bin/console doctrine:fixtures:load --purge-with-truncate --no-interaction
```

How to run it?
==============
- Open http://localhost:8082 url at some browser (Chrome, Firefox, etc)

Contributors
============

- Richard Melo [Twitter](https://twitter.com/allucardster), [Linkedin](https://www.linkedin.com/in/richardmelo)
