# Laravel DataTables Html Plugin.

[![Latest Stable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/stable.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Total Downloads](https://poser.pugx.org/yajra/laravel-datatables-html/downloads.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Build Status](https://travis-ci.org/yajra/laravel-datatables-html.png?branch=master)](https://travis-ci.org/yajra/laravel-datatables-html)
[![Latest Unstable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/unstable.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![License](https://poser.pugx.org/yajra/laravel-datatables-html/license.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)

## CHANGELOG

### v9.2.4 - 2022-05-21

- Use $this in Editor events magic method #164

### v9.2.3 - 2022-05-21

- Add option to override results wrap key

### v9.2.2 - 2022-05-20

- Fix select2 paginated results and ajax setter

### v9.2.1 - 2022-05-19

- Fix select2 placeholder default id value
- Add select2 tests
- Fix select2 placeholder compatibility

### v9.2.0 - 2022-05-19

- Add postAjaxWithForm
- Fix multiple form values for select and checkbox #163

### v9.1.2 - 2022-05-14

- Fix Undefined property: Yajra\DataTables\Html\Builder::$instance

### v9.1.1 - 2022-05-14

- Fix Undefined array key "{plugin_name}"
- More tests

### v9.1.0 - 2022-05-14

- A lot of tests and fixes
- Fix #https://github.com/yajra/laravel-datatables-html/issues/162
- Added Column authorization

### v9.0.3 - 2022-05-13

- Fix attr setter

### v9.0.2 - 2022-05-13

- Fix opts and attr setter

### v9.0.1 - 2022-05-08

- Allow array for orthogonal column data
- REF: https://github.com/yajra/laravel-datatables/pull/2380

### v9.0.0 - 2022-05-08

- Add Laravel 9 support
- Remove Laravel 8 and below support
- Add phpstan static analysis
- Improve tests