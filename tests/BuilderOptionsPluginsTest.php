<?php

namespace Yajra\DataTables\Html\Tests;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\SearchPane;

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

        $this->assertCount(1, $builder->getButtons());
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

    /** @test */
    public function it_has_responsive_plugin()
    {
        $builder = $this->getHtmlBuilder();
        $builder->responsive();

        $this->assertTrue($builder->getAttribute('responsive'));
        $this->assertTrue($builder->getResponsive());

        $builder->responsiveBreakpoints([1])
                ->responsiveDetailsDisplay('display')
                ->responsiveDetailsRenderer('renderer')
                ->responsiveDetailsTarget('target')
                ->responsiveDetailsType('type')
                ->responsiveOrthogonal('orthogonal');
        $this->assertEquals([1], $builder->getResponsive('breakpoints'));
        $this->assertEquals('display', $builder->getResponsive('details')['display']);
        $this->assertEquals('renderer', $builder->getResponsive('details')['renderer']);
        $this->assertEquals('target', $builder->getResponsive('details')['target']);
        $this->assertEquals('type', $builder->getResponsive('details')['type']);
        $this->assertEquals('orthogonal', $builder->getResponsive('orthogonal'));
    }

    /** @test */
    public function it_has_row_group_plugin()
    {
        $builder = $this->getHtmlBuilder();
        $builder->rowGroup();

        $this->assertTrue($builder->getAttribute('rowGroup'));
        $this->assertTrue($builder->getRowGroup());

        $builder->rowGroupDataSrc([1])
                ->rowGroupEmptyDataGroup()
                ->rowGroupEnable()
                ->rowGroupEndClassName()
                ->rowGroupEndRender('fn')
                ->rowGroupStartClassName()
                ->rowGroupStartRender();

        $this->assertEquals([1], $builder->getRowGroup('dataSrc'));
        $this->assertEquals('No Group', $builder->getRowGroup('emptyDataGroup'));
        $this->assertEquals(true, $builder->getRowGroup('enable'));
        $this->assertEquals('group-end', $builder->getRowGroup('endClassName'));
        $this->assertEquals('fn', $builder->getRowGroup('endRender'));
        $this->assertEquals('group-start', $builder->getRowGroup('startClassName'));
        $this->assertEquals(null, $builder->getRowGroup('startRender'));
    }

    /** @test */
    public function it_has_row_reorder_plugin()
    {
        $builder = $this->getHtmlBuilder();
        $builder->rowReorder();

        $this->assertTrue($builder->getAttribute('rowReorder'));
        $this->assertTrue($builder->getRowReorder());

        $builder->rowReorderDataSrc([1])
                ->rowReorderEditor('editor')
                ->rowReorderEnable()
                ->rowReorderFormOptions(['main' => []])
                ->rowReorderSelector()
                ->rowReorderSnapX()
                ->rowReorderUpdate();

        $this->assertEquals([1], $builder->getRowReorder('dataSrc'));
        $this->assertEquals('editor', $builder->getRowReorder('editor'));
        $this->assertEquals(true, $builder->getRowReorder('enable'));
        $this->assertEquals(['main' => []], $builder->getRowReorder('formOptions'));
        $this->assertEquals('td:first-child', $builder->getRowReorder('selector'));
        $this->assertEquals(true, $builder->getRowReorder('snapX'));
        $this->assertEquals(true, $builder->getRowReorder('update'));
    }

    /** @test */
    public function it_has_scroller_plugin()
    {
        $builder = $this->getHtmlBuilder();
        $builder->scroller();

        $this->assertTrue($builder->getAttribute('scroller'));
        $this->assertTrue($builder->getScroller());

        $builder->scrollerBoundaryScale()
                ->scrollerDisplayBuffer()
                ->scrollerLoadingIndicator()
                ->scrollerRowHeight()
                ->scrollerServerWait();

        $this->assertEquals(0.5, $builder->getScroller('boundaryScale'));
        $this->assertEquals(9, $builder->getScroller('displayBuffer'));
        $this->assertEquals(true, $builder->getScroller('loadingIndicator'));
        $this->assertEquals('auto', $builder->getScroller('rowHeight'));
        $this->assertEquals(200, $builder->getScroller('serverWait'));
    }

    /** @test */
    public function it_has_search_panes_plugin()
    {
        $builder = $this->getHtmlBuilder();
        $builder->searchPanes();

        $this->assertEquals(['show' => true], $builder->getAttribute('searchPanes'));
        $this->assertIsArray($builder->getSearchPanes());

        $builder->searchPanes(false);
        $this->assertEquals(['show' => false], $builder->getAttribute('searchPanes'));

        $builder->searchPanes(['hide' => true]);
        $this->assertEquals(['hide' => true], $builder->getAttribute('searchPanes'));

        $builder->searchPanes(function () {
            return ['show' => true];
        });
        $this->assertEquals(['show' => true], $builder->getAttribute('searchPanes'));

        $builder->searchPanes(SearchPane::make()->show()->cascadePanes());
        $this->assertEquals(['show' => true, 'cascadePanes' => true], $builder->getAttribute('searchPanes'));
    }

    /** @test */
    public function it_has_select_plugin()
    {
        $builder = $this->getHtmlBuilder();
        $builder->select();

        $this->assertTrue($builder->getAttribute('select'));
        $this->assertTrue($builder->getSelect());

        $builder->selectBlurable()
                ->selectClassName()
                ->selectInfo()
                ->selectItems()
                ->selectSelector()
                ->selectStyle();

        $this->assertEquals(true, $builder->getSelect('blurable'));
        $this->assertEquals('selected', $builder->getSelect('className'));
        $this->assertEquals(true, $builder->getSelect('info'));
        $this->assertEquals('row', $builder->getSelect('items'));
        $this->assertEquals('td', $builder->getSelect('selector'));
        $this->assertEquals('os', $builder->getSelect('style'));

        $builder->selectAddClassName('test');
        $this->assertEquals('selected test', $builder->getSelect('className'));

        $builder->selectItemsRow();
        $this->assertEquals(Builder::SELECT_ITEMS_ROW, $builder->getSelect('items'));

        $builder->selectItemsColumn();
        $this->assertEquals(Builder::SELECT_ITEMS_COLUMN, $builder->getSelect('items'));

        $builder->selectItemsCell();
        $this->assertEquals(Builder::SELECT_ITEMS_CELL, $builder->getSelect('items'));

        $builder->selectStyleSingle();
        $this->assertEquals(Builder::SELECT_STYLE_SINGLE, $builder->getSelect('style'));

        $builder->selectStyleMulti();
        $this->assertEquals(Builder::SELECT_STYLE_MULTI, $builder->getSelect('style'));

        $builder->selectStyleOS();
        $this->assertEquals(Builder::SELECT_STYLE_OS, $builder->getSelect('style'));

        $builder->selectStyleMultiShift();
        $this->assertEquals(Builder::SELECT_STYLE_MULTI_SHIFT, $builder->getSelect('style'));

        $builder->selectStyleApi();
        $this->assertEquals(Builder::SELECT_STYLE_API, $builder->getSelect('style'));
    }

}
