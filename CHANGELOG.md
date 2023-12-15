# Laravel DataTables Html Plugin.

[![Latest Stable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/stable.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Total Downloads](https://poser.pugx.org/yajra/laravel-datatables-html/downloads.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Build Status](https://travis-ci.org/yajra/laravel-datatables-html.png?branch=master)](https://travis-ci.org/yajra/laravel-datatables-html)
[![Latest Unstable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/unstable.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![License](https://poser.pugx.org/yajra/laravel-datatables-html/license.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)

## CHANGELOG

### v10.12.0 - 2023-12-15

- feat: allow macro on Field #213

### v10.11.0 - 2023-11-06

- feat: add batch remove optimization script (optional) #212

### v10.10.0 - 2023-11-04

- feat: Add optional scout js script #210
- feat: add script support when using editor #211

### v10.9.1 - 2023-10-04

- fix: add missing Arrayable param #208
- fix phpstan error: Parameter #1 $value of method Yajra\DataTables\Html\Builder::searchPanes() expects array|bool|(callable(): mixed), Yajra\DataTables\Html\SearchPane given.

### v10.9.0 - 2023-10-02

- feat: add dtsp collapse option setter #206
- feat: add initCollapsed option setter #207

### v10.8.2 - 2023-10-02

- fix: show searchPanes by default #205

### v10.8.1 - 2023-08-16

- Revert "fix: Mixed Content problem with updating minifiedAjax method and get current url based on http or https scheme" #202
- Reverts #186 
- fix: #201

### v10.8.0 - 2023-07-31

- fix: Mixed Content problem with updating minifiedAjax method and get current url based on http or https scheme #186
- fix: #194
- feat: add exportRender method #195

### v10.7.0 - 2023-06-08

- feat: new method for enum options #196

### v10.6.0 - 2023-03-31

- feat: thead class builder #191
- fix: #169 
- fix: [yajra/laravel-datatables#2706](https://github.com/yajra/laravel-datatables/issues/2706)

### v10.5.2 - 2023-03-31

- fix: backward compatibility with FormOptions class #190

### v10.5.1 - 2023-03-28

- fix: scripts attributes not working #189

### v10.5.0 - 2023-03-02

- feat: hide/show fields based on editor action #188
  - hiddenOnCreate
  - hiddenOnEdit
  - hiddenOn

### v10.4.0 - 2023-03-02

- feat: add datetime field options #187
  - wireFormat
  - keyInput
  - displayFormat

### v10.3.1 - 2023-02-20

- fix: too long file name check for column render #185

### v10.3.0 - 2023-02-20

- feat: add builder ability to use viteJs by default #184

### v10.2.0 - 2023-02-20

- feat: allow callable exportFormat parameter #167

### v10.1.0 - 2023-02-07

- Drop Collective\Html dependency #183
- Copy Collective HtmlBuilder class and implemented php-stan

### v10.0.0 - 2023-02-07

- Add Laravel 10 specific support
