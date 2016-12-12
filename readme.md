# Laravel PHP Framework

# TodosBackend
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pmartinez85/TodosBackend/badges/quality-score.png?b=tests)](https://scrutinizer-ci.com/g/pmartinez85/TodosBackend/?branch=tests)
[![Build Status](https://travis-ci.org/pmartinez85/TodosBackend.svg?branch=tests)](https://travis-ci.org/pmartinez85/TodosBackend)
[![Coverage Status](https://coveralls.io/repos/github/pmartinez85/TodosBackend/badge.svg?branch=tests)](https://coveralls.io/github/pmartinez85/TodosBackend?branch=tests)

Repositori d'una API que implementa les operacions CRUD de tasques i usuaris.

**Instal·lació**
    
$ git clone git@github.com:pmartinez85/TodosBackend.git

$ composer install

$ npm install

$ cp .env.example .env

$ php artisan key:generate

$ llum boot

$ php artisan vendor:publish --tag=adminlte --force


**Procediment d'ús**

$ php artisan migrate --seed

$ llum serve

**Testos**

$ phpunit