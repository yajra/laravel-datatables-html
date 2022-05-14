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

}
