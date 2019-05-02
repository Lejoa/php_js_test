PHP & JS Test
============================

* Build a small app in PHP (can be Symfony, Laravel, etc) that has one table/entity `products`. The table should have `id`, `name`, `description`, and `price`
* Seed a couple of sample products into the DB
* Build RESTful endpoints to Create Read Update Delete
* Deletes should be logical, not physical
* Build a small JavaScript app (can be inside the main PHP or a totally different app) that lists the products and allows the user to delete them

Requirements
============

- PHP >= 7.1.28
- Composer
- Git
- Bower
- SQLite

Installation
============

- Clone this repository
- From command line
```
:~$ cd php_js_test
:~$ composer install
:~$ touch var/data.db
:~$ echo "DATABASE_URL=sqlite:///%kernel.project_dir%/var/data.db" > .env.local
:~$ ./bin/console doctrine:schema:update --force
:~$ ./bin/console doctrine:fixtures:load
:~$ cd public
:~$ bower install
```

How to run it?
==============
- From command line
```
:~$ cd php_js_test
:~$ ./bin/console server:run
```

- Open the url in the browser

Contributors
============

- Richard Melo [Twitter](https://twitter.com/allucardster), [Linkedin](https://www.linkedin.com/in/richardmelo)
