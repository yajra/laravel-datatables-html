<?php

namespace Yajra\DataTables\Html\Tests;

use Yajra\DataTables\Html\Button;

class BuilderOptionsPluginsTest extends TestCase
{
    /** @test */
    public function it_has_autofill_plugin()
    {
        $builder = $this->getHtmlBuilder();

        $this->assertTrue($builder->getAutoFill());

        $builder->autoFill();
        $this->assertTrue($builder->getAttribute('autoFill'));

        $builder->autoFill(false);
        $this->assertFalse($builder->getAttribute('autoFill'));

        $builder->autoFillAlwaysAsk()
                ->autoFillColumns('autoFillColumns')
                ->autoFillEditor('autoFillEditor')
                ->autoFillEnable()
                ->autoFillFocus('autoFillFocus')
                ->autoFillHorizontal()
                ->autoFillUpdate()
                ->autoFillVertical();

        $this->assertTrue($builder->getAutoFill('alwaysAsk'));
        $this->assertEquals('autoFillColumns', $builder->getAutoFill('columns'));
        $this->assertEquals('autoFillEditor', $builder->getAutoFill('editor'));
        $this->assertEquals(true, $builder->getAutoFill('enable'));
        $this->assertEquals('autoFillFocus', $builder->getAutoFill('focus'));
        $this->assertEquals(true, $builder->getAutoFill('horizontal'));
        $this->assertEquals(true, $builder->getAutoFill('update'));
        $this->assertEquals(true, $builder->getAutoFill('vertical'));

        $builder->autoFillColumns([1, 2]);
        $this->assertEquals([1, 2], $builder->getAutoFill('columns'));
    }

    /** @test */
    public function it_has_buttons_plugin()
    {
        $builder = $this->getHtmlBuilder();
        $builder->buttons(
            Button::make('create'),
            Button::make('edit'),
        );

        $this->assertCount(2, $builder->getAttribute('buttons'));
        $this->assertCount(2, $builder->getButtons());
        $this->assertIsArray($builder->getButtons()[0]);

        $builder->buttons([
            Button::make('remove'),
        ]);

        $this->assertCount(3, $builder->getButtons());
    }

    /** @test */
    public function it_has_col_reorder_plugin()
    {
        $builder = $this->getHtmlBuilder();
        $builder->colReorder();

        $this->assertTrue($builder->getAttribute('colReorder'));
        $this->assertTrue($builder->getColReorder());

        $builder->colReorderEnable()
                ->colReorderFixedColumnsLeft(1)
                ->colReorderFixedColumnsRight(1)
                ->colReorderOrder([1])
                ->colReorderRealtime();

        $this->assertTrue($builder->getColReorder('enable'));
        $this->assertEquals(1, $builder->getColReorder('fixedColumnsLeft'));
        $this->assertEquals(1, $builder->getColReorder('fixedColumnsRight'));
        $this->assertEquals([1], $builder->getColReorder('order'));
        $this->assertEquals(true, $builder->getColReorder('realtime'));
    }

    /** @test */
    public function it_has_fixed_columns_plugin()
    {
        $builder = $this->getHtmlBuilder();
        $builder->fixedColumns();

        $this->assertTrue($builder->getAttribute('fixedColumns'));
        $this->assertTrue($builder->getFixedColumns());

        $builder->fixedColumnsHeightMatch()
                ->fixedColumnsLeftColumns()
                ->fixedColumnsRightColumns();

        $this->assertEquals('semiauto', $builder->getFixedColumns('heightMatch'));
        $this->assertEquals(1, $builder->getFixedColumns('leftColumns'));
        $this->assertEquals(0, $builder->getFixedColumns('rightColumns'));
    }

    /** @test */
    public function it_has_fixed_header_plugin()
    {
        $builder = $this->getHtmlBuilder();
        $builder->fixedHeader();

        $this->assertTrue($builder->getAttribute('fixedHeader'));
        $this->assertTrue($builder->getFixedHeader());

        $builder->fixedHeaderFooter()
                ->fixedHeaderFooterOffset()
                ->fixedHeaderHeader()
                ->fixedHeaderHeaderOffset();

        $this->assertEquals(true, $builder->getFixedHeader('footer'));
        $this->assertEquals(0, $builder->getFixedHeader('offset'));
        $this->assertEquals(true, $builder->getFixedHeader('header'));
        $this->assertEquals(0, $builder->getFixedHeader('headerOffset'));
    }

    /** @test */
    public function it_has_keys_plugin()
    {

        $builder = $this->getHtmlBuilder();
        $builder->keys();

        $this->assertTrue($builder->getAttribute('keys'));
        $this->assertTrue($builder->getKeys());

        $builder->keysBlurable()
                ->keysClassName()
                ->keysClipboard()
                ->keysClipboardOrthogonal()
                ->keysColumns('name')
                ->keysEditAutoSelect()
                ->keysEditOnFocus()
                ->keysEditor('editor')
                ->keysEditorKeys()
                ->keysFocus(':eq(0)')
                ->keysKeys(["charCodeAt(0)"])
                ->keysTabIndex(1);

        $this->assertEquals(true, $builder->getKeys('blurable'));
        $this->assertEquals('focus', $builder->getKeys('className'));
        $this->assertEquals(true, $builder->getKeys('clipboard'));
        $this->assertEquals('display', $builder->getKeys('clipboardOrthogonal'));
        $this->assertEquals('name', $builder->getKeys('columns'));
        $this->assertEquals(true, $builder->getKeys('editAutoSelect'));
        $this->assertEquals(true, $builder->getKeys('editOnFocus'));
        $this->assertEquals('editor', $builder->getKeys('editor'));
        $this->assertEquals('navigation-only', $builder->getKeys('editorKeys'));
        $this->assertEquals(':eq(0)', $builder->getKeys('focus'));
        $this->assertEquals(["charCodeAt(0)"], $builder->getKeys('keys'));
        $this->assertEquals(1, $builder->getKeys('tabIndex'));
    }


}
