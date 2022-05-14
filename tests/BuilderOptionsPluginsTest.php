<?php

namespace Yajra\DataTables\Html\Tests;

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

}
