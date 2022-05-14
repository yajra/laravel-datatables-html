<?php

namespace Yajra\DataTables\Html\Tests;

class BuilderOptionsLanguageTest extends TestCase
{
    /** @test */
    public function it_has_language_aria_options()
    {
        $builder = $this->getHtmlBuilder();
        $builder->languageAria(['paginate' => ['first' => 'First']]);
        $this->assertEquals(['paginate' => ['first' => 'First']], $builder->getLanguage('aria'));

        $builder->languageAriaPaginate(['first' => 'First']);
        $this->assertEquals(['first' => 'First'], $builder->getLanguage('aria')['paginate']);

        $builder->languageAriaPaginateFirst('First');
        $this->assertEquals('First', $builder->getLanguage('aria')['paginate']['first']);

        $builder->languageAriaPaginateLast('Last');
        $this->assertEquals('Last', $builder->getLanguage('aria')['paginate']['last']);

        $builder->languageAriaPaginateNext('Next');
        $this->assertEquals('Next', $builder->getLanguage('aria')['paginate']['next']);

        $builder->languageAriaPaginatePrevious('Previous');
        $this->assertEquals('Previous', $builder->getLanguage('aria')['paginate']['previous']);

        $builder->languageAriaSortAscending('languageAriaSortAscending');
        $this->assertEquals('languageAriaSortAscending', $builder->getLanguage('aria')['sortAscending']);

        $builder->languageAriaSortDescending('languageAriaSortDescending');
        $this->assertEquals('languageAriaSortDescending', $builder->getLanguage('aria')['sortDescending']);
    }

    /** @test */
    public function it_has_language_autofill_options()
    {
        $builder = $this->getHtmlBuilder();
        $builder->languageAutoFill(['button' => 'button']);
        $this->assertEquals(['button' => 'button'], $builder->getLanguage('autoFill'));

        $builder->languageAutoFillButton('button');
        $this->assertEquals('button', $builder->getLanguage('autoFill')['button']);

        $builder->languageAutoFillCancel('cancel');
        $this->assertEquals('cancel', $builder->getLanguage('autoFill')['cancel']);

        $builder->languageAutoFillFill('fill');
        $this->assertEquals('fill', $builder->getLanguage('autoFill')['fill']);

        $builder->languageAutoFillFillHorizontal('languageAutoFillFillHorizontal');
        $this->assertEquals('languageAutoFillFillHorizontal', $builder->getLanguage('autoFill')['fillHorizontal']);

        $builder->languageAutoFillFillVertical('languageAutoFillFillVertical');
        $this->assertEquals('languageAutoFillFillVertical', $builder->getLanguage('autoFill')['fillVertical']);

        $builder->languageAutoFillIncrement('languageAutoFillIncrement');
        $this->assertEquals('languageAutoFillIncrement', $builder->getLanguage('autoFill')['increment']);

        $builder->languageAutoFillInfo('languageAutoFillInfo');
        $this->assertEquals('languageAutoFillInfo', $builder->getLanguage('autoFill')['info']);
    }

    /** @test */
    public function it_has_language_paginate_options()
    {
        $builder = $this->getHtmlBuilder();
        $builder->languagePaginate(['first' => 'First']);
        $this->assertEquals(['first' => 'First'], $builder->getLanguage('paginate'));

        $builder->languagePaginateFirst('languagePaginateFirst');
        $this->assertEquals('languagePaginateFirst', $builder->getLanguage('paginate')['first']);

        $builder->languagePaginateLast('languagePaginateLast');
        $this->assertEquals('languagePaginateLast', $builder->getLanguage('paginate')['last']);

        $builder->languagePaginateNext('languagePaginateNext');
        $this->assertEquals('languagePaginateNext', $builder->getLanguage('paginate')['next']);

        $builder->languagePaginatePrevious('languagePaginatePrevious');
        $this->assertEquals('languagePaginatePrevious', $builder->getLanguage('paginate')['previous']);
    }

    /** @test */
    public function it_has_language_select_options()
    {
        $builder = $this->getHtmlBuilder();
        $builder->languageSelect(['cells' => 1]);
        $this->assertEquals(['cells' => 1], $builder->getLanguage('select'));

        $builder->languageSelectCells('languageSelectCells');
        $this->assertEquals('languageSelectCells', $builder->getLanguage('select')['cells']);

        $builder->languageSelectCells([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $builder->getLanguage('select')['cells']);

        $builder->languageSelectColumns('languageSelectColumns');
        $this->assertEquals('languageSelectColumns', $builder->getLanguage('select')['columns']);

        $builder->languageSelectColumns([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $builder->getLanguage('select')['columns']);

        $builder->languageSelectRows('languageSelectRows');
        $this->assertEquals('languageSelectRows', $builder->getLanguage('select')['rows']);

        $builder->languageSelectRows([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $builder->getLanguage('select')['rows']);
    }
}
