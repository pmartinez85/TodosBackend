# TodosBackend

[![Software License][ico-license]](LICENSE.md)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pmartinez85/TodosBackend/badges/quality-score.png?b=tests)](https://scrutinizer-ci.com/g/pmartinez85/TodosBackend/?branch=tests)
[![Build Status](https://scrutinizer-ci.com/g/pmartinez85/TodosBackend/badges/build.png?b=tests)](https://scrutinizer-ci.com/g/pmartinez85/TodosBackend/build-status/tests)
[![Build Status](https://travis-ci.org/pmartinez85/TodosBackend.svg?branch=tests)](https://travis-ci.org/pmartinez85/TodosBackend)
[![Code Coverage](https://scrutinizer-ci.com/g/pmartinez85/TodosBackend/badges/coverage.png?b=tests)](https://scrutinizer-ci.com/g/pmartinez85/TodosBackend/?branch=tests)

**Note:** Replace ```Pedro Martinez``` ```pmartinez85``` ```https://github.com/pmartinez85``` ```pmartinez1085@gmail.com``` ```pmartinez85``` ```TodosBackend``` ```API for TodosBackend from DAM 16/17``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line. You can run `$ php prefill.php` in the command line to make all replacements at once. Delete the file prefill.php as well.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

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

## Usage

``` php
$skeleton = new pmartinez85\TodosBackend();
echo $skeleton->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email pmartinez1085@gmail.com instead of using the issue tracker.

## Credits

- [Pedro Martinez][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/pmartinez85/TodosBackend/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/pmartinez85/TodosBackend.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/pmartinez85/TodosBackend.svg?style=flat-square

[link-travis]: https://travis-ci.org/pmartinez85/TodosBackend
[link-scrutinizer]: https://scrutinizer-ci.com/g/pmartinez85/TodosBackend/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/pmartinez85/TodosBackend
[link-downloads]: https://packagist.org/packages/pmartinez85/TodosBackend
[link-author]: https://github.com/pmartinez85
[link-contributors]: ../../contributors
