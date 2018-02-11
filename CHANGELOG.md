# Laravel DataTables Html Plugin.

[![Latest Stable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/stable.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Total Downloads](https://poser.pugx.org/yajra/laravel-datatables-html/downloads.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Build Status](https://travis-ci.org/yajra/laravel-datatables-html.png?branch=master)](https://travis-ci.org/yajra/laravel-datatables-html)
[![Latest Unstable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/unstable.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![License](https://poser.pugx.org/yajra/laravel-datatables-html/license.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)

## CHANGELOG

### v3.6.0 - 02-11-2018

- Add support for Laravel 5.6. [#56]

### v3.5.2 - 01-11-2018

- Moving callback condition to config [#54], credits to @lk77.

### v3.5.1 - 12-27-2017

- Allow jQuery functions callback. [#52], credits to @OzanKurt.

### v3.5.0 - 12-24-2017

- Improve handling of function callbacks and better editor support. [#49]

### v3.4.0 - 12-18-2017

- Implement buttons support for editor. [#47]

### v3.3.0 - 12-15-2017

- Add postAjax() to Html Builder [#45], credits to @ElfSundae.
- Fix https://github.com/yajra/laravel-datatables-html/pull/13#issuecomment-337947000.

### v3.2.1 - 10-18-2017

- Fix HtmlServiceProvider. [#38], credits to @ElfSundae.
- Fix changelog PR links. [#39]

### v3.2.0 - 10-13-2017

- Review tableAttributes getter and setter [#31]
- Fix CS. [#36]
- Add setTableId() to Html Builder [#35].
- Add addTableClass, removeTableClass to Html Builder [#37]
- All changes credits to @ElfSundae.

### v3.1.0 - 09-14-2017

- Added generateJson to Html/Builder [#29], credits to @lk77.

### v3.0.3 - 09-12-2017

- Fix column attributes removed when generate script. [#28], credits to @as247.
- Fix https://github.com/yajra/laravel-datatables/issues/1380.

### v3.0.2 - 09-09-2017

- Fix Request class doc blocks.
- Fix typo Datatables to DataTables.

### v3.0.1 - 09-09-2017

- Add fnServerParams to validCallbacks [#26]. Credits to @cracki.

### v3.0.0 - 08-31-2017

- v3.0 stable release.

### v2.0.6 - 07-29-2017

- Adding type GET to minifiedAjax in Html/Builder [#21], credits to @lk77.

### v2.0.5 - 06-29-2017

- Fix fetching of default table id from config. [#19]

### v2.0.4 - 06-29-2017

- Fix missing semi-colon.

### v2.0.3 - 06-29-2017

- Script cleanup [#18]
- Clean up extra space and floating ; on generated ajax data script.
- Do not include attributes on generated column scripts.

### v2.0.2 - 06-29-2017

- Fix parsing of column functions. [#17]

### v2.0.1 - 06-29-2017

- Fix parsing of ajax data where function is rendered as string. [#16]

### v2.0.0 - 06-28-2017

- Add support for Laravel 5.5
- Removed unused classes on constructor.
    - UrlGenerator
    - FormBuilder
- Fix addCheckbox.
- Use HtmlString when generating table and scripts markup.
- Make default table attributes configurable. Fix [#3]
- Use PHPUNIT 6.x, update tests.
- Add macroable trait for builder extension via macro calls.

### v1.4.1 - 06-26-2017

- Set default ajax url to empty string.

### v1.4.0 - 06-26-2017

- Add minifiedAjax method to minify url generated when using get request. [#13]
- Fixes `php artisan serve` and IE issues on long URL.
- Related Issues:
    yajra/laravel-datatables#1225
    yajra/laravel-datatables#1205
    yajra/laravel-datatables#826
    yajra/laravel-datatables#671
    etc...

### v1.3.0 - 06-24-2017

- Adding addBefore and addColumnBefore in Builder.
- PR [#12], credits to @lk77.

### v1.2.0 - 03-28-2017

- Add method to remove column by names. [#9]

### v1.1.1 - 03-28-2017

- Fix columns setter. [#8]

### v1.1.0 - 02-03-2017

- Configurable header attributes. [#4]
- Credits to @alfa6661.

### v1.0.0 - 01-27-2017

- First release.

[#4]: https://github.com/yajra/laravel-datatables-html/pull/4
[#8]: https://github.com/yajra/laravel-datatables-html/pull/8
[#9]: https://github.com/yajra/laravel-datatables-html/pull/9
[#12]: https://github.com/yajra/laravel-datatables-html/pull/12
[#13]: https://github.com/yajra/laravel-datatables-html/pull/13
[#16]: https://github.com/yajra/laravel-datatables-html/pull/16
[#17]: https://github.com/yajra/laravel-datatables-html/pull/17
[#18]: https://github.com/yajra/laravel-datatables-html/pull/18
[#19]: https://github.com/yajra/laravel-datatables-html/pull/19
[#21]: https://github.com/yajra/laravel-datatables-html/pull/21
[#26]: https://github.com/yajra/laravel-datatables-html/pull/26
[#28]: https://github.com/yajra/laravel-datatables-html/pull/28
[#29]: https://github.com/yajra/laravel-datatables-html/pull/29
[#31]: https://github.com/yajra/laravel-datatables-html/pull/31
[#35]: https://github.com/yajra/laravel-datatables-html/pull/35
[#36]: https://github.com/yajra/laravel-datatables-html/pull/36
[#37]: https://github.com/yajra/laravel-datatables-html/pull/37
[#38]: https://github.com/yajra/laravel-datatables-html/pull/38
[#39]: https://github.com/yajra/laravel-datatables-html/pull/39
[#47]: https://github.com/yajra/laravel-datatables-html/pull/47
[#49]: https://github.com/yajra/laravel-datatables-html/pull/49
[#52]: https://github.com/yajra/laravel-datatables-html/pull/52
[#54]: https://github.com/yajra/laravel-datatables-html/pull/54
[#56]: https://github.com/yajra/laravel-datatables-html/pull/56

[#3]: https://github.com/yajra/laravel-datatables-html/issues/3
