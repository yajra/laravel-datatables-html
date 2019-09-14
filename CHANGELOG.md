# Laravel DataTables Html Plugin.

[![Latest Stable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/stable.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Total Downloads](https://poser.pugx.org/yajra/laravel-datatables-html/downloads.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Build Status](https://travis-ci.org/yajra/laravel-datatables-html.png?branch=master)](https://travis-ci.org/yajra/laravel-datatables-html)
[![Latest Unstable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/unstable.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![License](https://poser.pugx.org/yajra/laravel-datatables-html/license.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)

## CHANGELOG

### v4.13.0 - 09-14-2019

- Add renderJs ability to pass parameter to js from php argument.
- `->renderJs('prefix', 'hrs')` == `->renderJs('prefix("hrs")')`

### v4.12.0 - 09-14-2019

- Add renderJs helper to use the built-in and custom renderer.
- Ex: `->renderJs("boolean()")`, `->renderJs("number()")`.

### v4.11.0 - 09-13-2019

- Add select2 ajax option support. [#109]

### v4.10.1 - 09-10-2019

- Remove editor dependency when display the image.
- Fix js issue when editing.

### v4.10.0 - 09-10-2019

- Fix displaying of uploaded image preview.
- Add File editor instance setter.

### v4.9.0 - 09-10-2019

- Add File and Image editor fields. [#108]

### v4.8.0 - 09-04-2019

- Add support Laravel 6.0 & remove deprecated functions [#107], credits to @sangnguyenplus.

### v4.7.1 - 08-31-2019

- Unset editor events key when serializing to array or json.
- Fix editor events script builder.

### v4.7.0 - 08-29-2019

- Add BelongsTo field builder.

```php
BelongsTo::model(Model::class, 'name')
```

### v4.6.0 - 08-29-2019

- Return static on Field for better IDE support.
- Add initial support for Select2 editor plugin.

### v4.5.4 - 08-22-2019

- Add missing buttons columns & exportOptions setter.

### v4.5.3 - 08-17-2019

- Fix error when no editor fields was defined. [52f0537c5913c84fb5e8a58bbd7db142b987daaf](https://github.com/yajra/laravel-datatables-html/commit/52f0537c5913c84fb5e8a58bbd7db142b987daaf)
- Return false when validating callback value is an array or an object. [b76cdf806c85368fce70a9034153dec6e107dd2f](https://github.com/yajra/laravel-datatables-html/commit/52f0537c5913c84fb5e8a58bbd7db142b987daaf)

### v4.5.2 - 08-13-2019

- Fix [#102] language key and use i18n. [#103], credits to @matteocostantini.

### v4.5.1 - 07-05-2019

- Add fluent column footer setter. [#101]

### v4.5.0 - 06-27-2019

- Add ability to generate dataTables options for external js use. [#99]

### v4.4.1 - 04-25-2019

- Add title attribute for table headers. [#94], credits to @HOFFMACHINE.


### v4.4.0 - 02-27-2019

- Add support for Laravel 5.8 / DataTables v9.0 [#90].

### v4.3.2 - 02-05-2019

- Avoid call parseRender when render attribute is null. [#87] credits to @JulianBustamante.

### v4.3.1 - 11-21-2018

- Allow null string computed column title.

### v4.3.0 - 11-21-2018

#### Added

- Builder Support for the following plugins:

- [x] AutoFill
- [x] ColReorder
- [x] FixedColumns
- [x] FixedHeader
- [x] KeyTable
- [x] Responsive
- [x] RowGroup
- [x] RowReorder
- [x] Scroller
- [x] Select

- Builder Support for setting the language:

- [x] Language
- [x] Language\Aria
- [x] Language\AutoFill
- [x] Language\Paginate
- [x] Language\Select

- Add missing column option setters:

- [x] data
- [x] orderData
- [x] orderDataType
- [x] orderSequence
- [x] cellType
- [x] type
- [x] contentPadding
- [x] createdCell
- [x] editField

### v4.2.1 - 11-21-2018

- Fix computed column title if nothing is set.

### v4.2.0 - 11-20-2018

- Add ajaxWithForm api to process dataTables with form data. [#86]

### v4.1.0 - 11-16-2018

- Add full Editor events script builder as per https://editor.datatables.net/reference/event/.

```php
Editor::make('create')
  ->on('create', 'js-script-here')
  ->onCreate('js-script-here') // event via magic method.
  ->fields([
      Fields\Text::make('name'),
      Fields\Text::make('email'),
  ]);
```

- Add missing `idSrc` Editor option setter.
- Add missing `display` Editor option setter.

> NOTE: You need to force [publish](https://github.com/yajra/laravel-datatables-html#publish-assets-optional) the blade templates to be able to use the features if needed.

### v4.0.0 - 11-14-2018

#### ADDED

Add full builder support for the following options based on https://datatables.net/reference/option/.

##### Add builder support for the following plugins:

- [x] AutoFill
- [x] Buttons
- [x] ColReorder
- [x] FixedColumns
- [x] FixedHeader
- [x] KeyTable
- [x] Responsive
- [x] RowGroup
- [x] RowReorder
- [x] Scroller
- [x] Select

> Note: All plugins requires their corresponding asset files.

##### Add Buttons builder with support for authorization.

```php
->buttons(
    Button::makeIfCan('manage-users', 'create')->editor('editor'),
    Button::makeIf(true, 'edit')->editor('editor'),
    Button::make('remove')->editor('editor')->className('btn-danger'),
    Button::make('colvis')->text('<i class="fa fa-eye"></i>'),
    Button::make('export'),
    Button::make('print'),
    Button::make('reset'),
    Button::make('reload')
)
```

#### CHANGED

- `Editor` class was moved from `Yajra\DataTables\Html\Editor` to `Yajra\DataTables\Html\Editor\Editor`.
- All fields were moved from `Yajra\DataTables\Html\Editor` to `Yajra\DataTables\Html\Editor\Fields` namespace.

### v3.13.0 - 11-10-2018

- Add missing visible option setter. [#83]
- Add new fields, fix dateTime field format. [#84]

#### Changed

- Fix field and column computed title.

From `created_at` with title `Created_At`
To `created_at` with title `Created At`

#### Fixed

- Fix DateTime field.
- Set format to `YYYY-MM-DD hh:mm a`.
- Add `military()` setter to set the time to military format.

#### Added New Fields

- Boolean
- Date
- Time
- Text
- Number

### v3.12.7 - 11-03-2018

- Add checker if className is not yet set when adding class.

### v3.12.6 - 11-03-2018

- Fix setting of title.
- Add title option for checkbox column.

### v3.12.5 - 11-03-2018

- Add name arg for computed column.

### v3.12.4 - 11-03-2018

- Fix options: Use 1 and 0 for true or false.

### v3.12.3 - Skipped (My Bad)

### v3.12.2 - 11-03-2018

- Add missing field options setter and add docs link.

### v3.12.1 - 11-03-2018

- Add to method to append a class to the field.

### v3.12.0 - 11-03-2018

- Add editor options collection builder. [#80]

### v3.11.0 - 11-02-2018

- Add option to prepend action column. [#77]
- Enhance column fluent builder. [#78]

### v3.10.0 - 11-02-2018

- Add support for DataTables Editor script generation. [#73]
- Fix script template config key `datatables-html.script`.
- Add method to `getAjaxUrl()`.

### v3.9.0 - 11-02-2018

- Add support for [built-in render helpers](https://datatables.net/manual/data/renderers#Built-in-helpers). [#71], credits to @Razoxane.

### v3.8.1 - 10-30-2018

- Fix the default name of index column to follow DT syntax. [#69], credits to @jaydons.
- Fix missing periods. [#70], credits to @jaydons.

### v3.8.0 - 09-05-2018

- Add support for Laravel 5.7

### v3.7.2 - 07-06-2018

- Fix callback check on empty values. [#62] Credits to @apreiml.

### v3.7.1 - 03-16-2018

- Add parameter in addCheckbox to prepend or append the checkbox column [#55], credits to @karmendra

### v3.7.0 - 02-21-2018

- Adding ajaxParameters to minifiedAjax [#57], credits to @lk77
- Fixes the issue with the missing name attribute default mentioned in [#58]. PR [#59], credits to @Namoshek

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
[#57]: https://github.com/yajra/laravel-datatables-html/pull/57
[#59]: https://github.com/yajra/laravel-datatables-html/pull/59
[#55]: https://github.com/yajra/laravel-datatables-html/pull/55
[#62]: https://github.com/yajra/laravel-datatables-html/pull/62
[#69]: https://github.com/yajra/laravel-datatables-html/pull/69
[#70]: https://github.com/yajra/laravel-datatables-html/pull/70
[#71]: https://github.com/yajra/laravel-datatables-html/pull/71
[#73]: https://github.com/yajra/laravel-datatables-html/pull/73
[#77]: https://github.com/yajra/laravel-datatables-html/pull/77
[#78]: https://github.com/yajra/laravel-datatables-html/pull/78
[#80]: https://github.com/yajra/laravel-datatables-html/pull/80
[#83]: https://github.com/yajra/laravel-datatables-html/pull/83
[#84]: https://github.com/yajra/laravel-datatables-html/pull/84
[#86]: https://github.com/yajra/laravel-datatables-html/pull/86
[#87]: https://github.com/yajra/laravel-datatables-html/pull/87
[#90]: https://github.com/yajra/laravel-datatables-html/pull/90
[#94]: https://github.com/yajra/laravel-datatables-html/pull/94
[#99]: https://github.com/yajra/laravel-datatables-html/pull/99
[#101]: https://github.com/yajra/laravel-datatables-html/pull/101
[#103]: https://github.com/yajra/laravel-datatables-html/pull/103
[#107]: https://github.com/yajra/laravel-datatables-html/pull/107
[#108]: https://github.com/yajra/laravel-datatables-html/pull/108
[#109]: https://github.com/yajra/laravel-datatables-html/pull/109

[#3]: https://github.com/yajra/laravel-datatables-html/issues/3
[#58]: https://github.com/yajra/laravel-datatables-html/issues/58
[#102]: https://github.com/yajra/laravel-datatables-html/issues/102
