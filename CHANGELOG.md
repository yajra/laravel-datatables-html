## Laravel Datatables Html Plugin.

[![Latest Stable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/stable.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Total Downloads](https://poser.pugx.org/yajra/laravel-datatables-html/downloads.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Build Status](https://travis-ci.org/yajra/laravel-datatables-html.png?branch=master)](https://travis-ci.org/yajra/laravel-datatables-html)
[![Latest Unstable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/unstable.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![License](https://poser.pugx.org/yajra/laravel-datatables-html/license.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)

## Change Log

### v2.0.2 - 06-29-2017
- Fix parsing of column functions. #17

### v2.0.1 - 06-29-2017
- Fix parsing of ajax data where function is rendered as string. #16

### v2.0.0 - 06-28-2017
- Add support for Laravel 5.5
- Removed unused classes on constructor.
    - UrlGenerator
    - FormBuilder
- Fix addCheckbox.
- Use HtmlString when generating table and scripts markup.
- Make default table attributes configurable. Fix #3
- Use PHPUNIT 6.x, update tests.
- Add macroable trait for builder extension via macro calls.

### v1.4.1 - 06-26-2017
- Set default ajax url to empty string.

### v1.4.0 - 06-26-2017
- Add minifiedAjax method to minify url generated when using get request. #13
- Fixes `php artisan serve` and IE issues on long URL.
- Related Issues:
    yajra/laravel-datatables#1225
    yajra/laravel-datatables#1205
    yajra/laravel-datatables#826
    yajra/laravel-datatables#671
    etc...

### v1.3.0 - 06-24-2017
- Adding addBefore and addColumnBefore in Builder.
- PR #12, credits to @lk77.

### v1.2.0 - 03-28-2017
- Add method to remove column by names. #9

### v1.1.1 - 03-28-2017
- Fix columns setter. #8

### v1.1.0 - 02-03-2017
- Configurable header attributes. #4
- Credits to @alfa6661.

### v1.0.0 - 01-27-2017
- First release.
