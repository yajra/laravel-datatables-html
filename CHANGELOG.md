# Laravel DataTables Html Plugin.

[![Latest Stable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/stable.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Total Downloads](https://poser.pugx.org/yajra/laravel-datatables-html/downloads.png)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![Build Status](https://travis-ci.org/yajra/laravel-datatables-html.png?branch=master)](https://travis-ci.org/yajra/laravel-datatables-html)
[![Latest Unstable Version](https://poser.pugx.org/yajra/laravel-datatables-html/v/unstable.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)
[![License](https://poser.pugx.org/yajra/laravel-datatables-html/license.svg)](https://packagist.org/packages/yajra/laravel-datatables-html)

## CHANGELOG

### v4.36.0 - 11-14-2020

- Add drawCallbackWithLivewire api.
- Solution as per issue https://github.com/yajra/laravel-datatables/issues/2401.

### v4.35.2 - 11-14-2020

- Add missing button options as per [docs](https://datatables.net/reference/option/#buttons).

### v4.35.1 - 11-03-2020

- Add missing upload field options as per doc. [#152]

### v4.35.0 - 11-03-2020

- Add formatted column factory. [#147]

### v4.34.0 - 10-31-2020

- Add support for search panes extension. [#137]

### v4.33.0 - 10-30-2020

- Make LaravelDataTables javascript namespace configurable. [#145], credits to @om3rcitak

### v4.32.0 - 10-10-2020

- Add function argument to override the default options from php scripts. [#144]

### v4.31.0 - 10-09-2020

- Add button customize option value. [#142], credits to @gredimano
- Fix https://github.com/yajra/laravel-datatables/issues/1541
- Add template and method to wrap scripts with a function. [#143]

### v4.30.3 - 10-06-2020

- Wait for DOM before executing script using jQuery [#138]
- Fix [#133]

### v4.30.2 - 10-06-2020

- Fix chrome bfcache issue with editor. [#139], credits to @jiwom
- Allow using callbacks as a data value. [#127], credits to @mgralikowski

### v4.30.1 - 09-29-2020

- Fix [#134] laravel 8 dependencies [#135], credits to @dyanakiev.

### v4.30.0 - 06-18-2020

- Add button align property setter.

### v4.29.0 - 06-17-2020

- Add column responsive priority setter. [#131], credits to @SamDeimos.

### v4.28.0 - 06-10-2020

- Allow eloquent builder instance on BelongsTo model field.

### v4.27.0 - 05-29-2020

- Add renderRaw method to set render value as is.

### v4.26.1 - 05-29-2020

- Fix array listing and allow customer separator.

### v4.26.0 - 05-29-2020

- Add support for comma separated list from an array of objects.

### v4.25.1 - 04-17-2020

- Fix PR [#125].

### v4.25.0 - 04-17-2020

- HTML title for columns labels [#125], credits to @mgralikowski.

### v4.24.0 - 04-02-2020

- Add TextArea rows & cols fluent attribute setter.

### v4.23.1 - 03-04-2020

- Improve addClass method. [#117], credits to @matteocostantini.

### v4.23.0 - 03-04-2020

- Allow Laravel 7 [#124], credits to @barryvdh.

### v4.22.0 - 03-03-2020

- Add shortcut method `hidden` to hide column instead of `visible(false)`.

### v4.21.1 - 02-21-2020

- Use full url on ajax if not set. [#122]
- Fix [yajra/laravel-datatables#2322](https://github.com/yajra/laravel-datatables/issues/2322).
- Fix [#121]

### v4.21.0 - 02-18-2020

- Add editor button formMessage and formTitle fluent setter.

### v4.20.2 - 02-17-2020

- Fix export function not working when base url is set on header.

### v4.20.1 - 11-11-2019

- Fix substring to substr [#116].

### v4.20.0 - 11-11-2019

- Improve adding custom action to buttons. [#114], credits to @om3rcitak.

### v4.19.4 - 10-02-2019

- Fix serialization of renderJs parameters. [#110]
- Allow array parameter on buttons option for api consistency. [#111]
- Allow array parameter on editors option for api consistency. [#112]

### v4.19.3 - 09-27-2019

- Fix Button class doc return type to static.

### v4.19.2 - 09-27-2019

- Fix authorization options to allow null.

### v4.19.1 - 09-27-2019

- Fix missing button name attr setter.

### v4.19.0 - 09-25-2019

- Add Editor formOptions setter as per docs: https://editor.datatables.net/reference/option/formOptions.

### v4.18.2 - 09-25-2019

- Fix ajax data if value is an array.

### v4.18.1 - 09-25-2019

- Add ajax url setter.
- Fix ajax option if array was passed.

### v4.18.0 - 09-23-2019

- Add makeIfCannot authorization.

```php
Field\Text::makeIfCannot('evaluate', 'evaluator_id')->data('evaluator.name')...
```

### v4.17.0 - 09-23-2019

- Add support for Field class authorizations.
- Fix doc blocks and phpstorm warnings.

```php
Field\Select::makeIfCan('evaluate', 'evaluator_id')...
Field\Select::makeIf(true, 'evaluator_id')...
Field\Select::makeIf(function() { return true; }, 'evaluator_id')...
```

### v4.16.0 - 09-20-2019

- Add action script helpers.
- New actions: `actionSubmit(), actionClose(), actionHandler('editor-method-handler')`

```php
Button::make('edit')
      ->editor('evaluator')
      ->text('<i class="fa fa-check-circle"></i> Evaluate')
      ->formButtons([
          Button::raw('Approve')
                ->className('btn btn-success ml-2')
                ->actionHandler('approve'),
          Button::raw('Decline')
                ->className('btn btn-danger ml-2')
                ->actionHandler('decline'),
          Button::raw('Cancel')
                ->className('btn btn-secondary ml-2')
                ->actionClose(),
      ])
      ->className('btn-success'),
```

- Add missing formButtons and action setter.
- Add raw buttons factory.

```php
Button::make('edit')
  ->editor('approver')
  ->text('<i class="fa fa-check-circle"></i> Approve Leave')
  ->formButtons([
      Button::raw('Approve')
            ->className('btn btn-success')
            ->action('function() { this.submit(); }'),
      Button::raw('Cancel')
            ->className('btn btn-secondary ml-2')
            ->action('function() { this.close(); }'),
  ])
  ->className('btn-success'),
```

### v4.14.2 - 09-17-2019

- Add missing Button buttons setter.

### v4.14.1 - 09-16-2019

- Fix Number field and set type attr to number.
- Add missing attr setter.
- Fix doc blocks for better IDE support.

### v4.14.0 - 09-16-2019

- Add more dateTime opts setter.

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
[#110]: https://github.com/yajra/laravel-datatables-html/pull/110
[#111]: https://github.com/yajra/laravel-datatables-html/pull/111
[#112]: https://github.com/yajra/laravel-datatables-html/pull/112
[#114]: https://github.com/yajra/laravel-datatables-html/pull/114
[#116]: https://github.com/yajra/laravel-datatables-html/pull/116
[#122]: https://github.com/yajra/laravel-datatables-html/pull/122
[#124]: https://github.com/yajra/laravel-datatables-html/pull/124
[#117]: https://github.com/yajra/laravel-datatables-html/pull/117
[#125]: https://github.com/yajra/laravel-datatables-html/pull/125
[#131]: https://github.com/yajra/laravel-datatables-html/pull/131
[#135]: https://github.com/yajra/laravel-datatables-html/pull/135
[#127]: https://github.com/yajra/laravel-datatables-html/pull/127
[#139]: https://github.com/yajra/laravel-datatables-html/pull/139
[#138]: https://github.com/yajra/laravel-datatables-html/pull/138
[#133]: https://github.com/yajra/laravel-datatables-html/pull/133
[#142]: https://github.com/yajra/laravel-datatables-html/pull/142
[#143]: https://github.com/yajra/laravel-datatables-html/pull/143
[#144]: https://github.com/yajra/laravel-datatables-html/pull/144
[#137]: https://github.com/yajra/laravel-datatables-html/pull/137
[#147]: https://github.com/yajra/laravel-datatables-html/pull/147
[#152]: https://github.com/yajra/laravel-datatables-html/pull/152

[#134]: https://github.com/yajra/laravel-datatables-html/issues/134
[#3]: https://github.com/yajra/laravel-datatables-html/issues/3
[#58]: https://github.com/yajra/laravel-datatables-html/issues/58
[#102]: https://github.com/yajra/laravel-datatables-html/issues/102
[#121]: https://github.com/yajra/laravel-datatables-html/issues/121
