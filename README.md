Calculator
========================

Une calculatrice simple.

Installation
------------
PHP8+ est requis

Récupérer le dépôt.

```bash
git clone https://github.com/falylala15/calculatrice.git
```

Lancer docker

```bash
$ docker-compose up -d
```

Installation des dépendances
----------------------------

```bash
$ docker-compose exec php-fpm composer install
$ docker-compose exec php-fpm yarn encore dev 
```

Lien http://localhost:8080/

Tests
-----

Lancer les tests:

```bash
$ docker-compose exec php-fpm bin/phpunit
```