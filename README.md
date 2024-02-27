# Laravel DataTables Html Plugin

[![Laravel 11.x](https://img.shields.io/badge/Laravel-11.x-orange.svg)](http://laravel.com)
[![Latest Stable Version](https://img.shields.io/packagist/v/yajra/laravel-datatables-html.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)
![Build Status](https://github.com/yajra/laravel-datatables-html/workflows/tests/badge.svg)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yajra/laravel-datatables-html/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yajra/laravel-datatables-html/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/yajra/laravel-datatables-html.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)

This package is a plugin of [Laravel DataTables](https://github.com/yajra/laravel-datatables) for generating dataTables script using PHP.

## Requirements

- [Laravel 11.x](https://github.com/laravel/framework)
- [Laravel DataTables](https://github.com/yajra/laravel-datatables)

## Documentations

- [Laravel DataTables Documentation](http://yajrabox.com/docs/laravel-datatables)
- [Demo Application](http://datatables.yajrabox.com) is available for artisan's reference.

## Laravel Version Compatibility

| Laravel       | Package |
|:--------------|:--------|
| 8.x and below | 4.x     |
| 9.x           | 9.x     |
| 10.x          | 10.x    |
| 11.x          | 11.x    |

## Quick Installation

`composer require yajra/laravel-datatables-html:^11`

#### Setup scripts with ViteJS

Set the default javascript type to `module` by setting `Builder::useVite()` in the `AppServiceProvider`.

```php
namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Builder::useVite();
    }
}
```

#### Publish Assets (Optional)

`$ php artisan vendor:publish --tag=datatables-html`

And that's it! Start building out some awesome DataTables!

## Contributing

Please see [CONTRIBUTING](https://github.com/yajra/laravel-datatables-html/blob/master/.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email [aqangeles@gmail.com](mailto:aqangeles@gmail.com) instead of using the issue tracker.

## Credits

- [Arjay Angeles](https://github.com/yajra)
- [All Contributors](https://github.com/yajra/laravel-datatables-html/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/yajra/laravel-datatables-html/blob/master/LICENSE.md) for more information.
