# Laravel DataTables Html Plugin.

[![Latest Stable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/stable.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Total Downloads](https://poser.pugx.org/yajra/laravel-datatables-html/downloads.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Build Status](https://travis-ci.org/yajra/laravel-datatables-html.png?branch=master)](https://travis-ci.org/yajra/laravel-datatables-html)
[![Latest Unstable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/unstable.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![License](https://poser.pugx.org/yajra/laravel-datatables-html/license.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)

## CHANGELOG

### v9.4.3 - 2025-09-06

- Fix namespace of laravellux/html in Html/Builder #243

### v9.4.2 - 2025-09-03

- Fix namespace of laravellux/html HtmlServiceProvider #242
- Fixes #241

### v9.4.1 - 2025-08-29

- fix: change laravelcollective/html form to laravellux/html #240

### v9.4.0 - 2023-02-20

- feat: allow callable exportFormat parameter #167
- feat: Add onPreClose Event #179
- feat: Add onOpened Event  #177
- feat: Add initEditor Event #176
- feat: Add onClosed Event #175

### v9.3.4 - 2022-10-06

- fix(editor): Fix typehint to match value helper #172

### v9.3.3 - 2022-10-05

- Fix ajax form search with textarea #171

### v9.3.2 - 2022-07-04

- Fix collection key - value

### v9.3.1 - 2022-07-04

- Fix magic property type

### v9.3.0 - 2022-07-01

- Add nullDefault() method #166

### v9.2.6 - 2022-06-30

- Allow array on default() method #165

### v9.2.5 - 2022-06-02

- Added: Builder addButton method
- Changed: Builder buttons method will reset existing buttons

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
