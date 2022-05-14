<?php

namespace Yajra\DataTables\Html\Tests;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class BuilderTest extends TestCase
{
    /** @test */
    public function it_can_resolved_builder_class()
    {
        $builder = $this->getHtmlBuilder();

        $this->assertInstanceOf(Builder::class, $builder);

        $builder = app('datatables.html');
        $this->assertInstanceOf(Builder::class, $builder);
    }

    /** @test */
    public function it_can_read_table_id_from_config()
    {
        $this->assertEquals('dataTableBuilder', $this->getHtmlBuilder()->getTableId());

        config()->set('datatables-html.table.id', 'test');

        $this->assertEquals('test', $this->getHtmlBuilder()->getTableId());
    }

    /** @test */
    public function it_can_change_namespace()
    {
        $builder = $this->getHtmlBuilder();

        $this->assertStringContainsString('LaravelDataTables', $builder->scripts()->toHtml());

        config()->set('datatables-html.namespace', 'TestDataTables');

        $this->assertStringContainsString('TestDataTables', $builder->scripts()->toHtml());
    }

    /** @test */
    public function it_can_generate_table_html_and_scripts()
    {
        $builder = $this->getHtmlBuilder();

        $builder->setTableId('foo-table')
                ->columns([
                    Column::make('foo'),
                    Column::make('baz'),
                ]);

        $table = $builder->table()->toHtml();

        $expected = '<table class="table" id="foo-table"><thead><tr><th title="Foo">Foo</th><th title="Baz">Baz</th></tr></thead></table>';
        $this->assertEquals($expected, $table);

        $script = $builder->scripts()->toHtml();
        $expected = '<script type="text/javascript">$(function(){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["foo-table"]=$("#foo-table").DataTable({"serverSide":true,"processing":true,"ajax":"","columns":[{"data":"foo","name":"foo","title":"Foo","orderable":true,"searchable":true},{"data":"baz","name":"baz","title":"Baz","orderable":true,"searchable":true}]});});</script>';
        $this->assertEquals($expected, $script);

        $expected = '$(function(){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["foo-table"]=$("#foo-table").DataTable({"serverSide":true,"processing":true,"ajax":"","columns":[{"data":"foo","name":"foo","title":"Foo","orderable":true,"searchable":true},{"data":"baz","name":"baz","title":"Baz","orderable":true,"searchable":true}]});});';
        $this->assertEquals($expected, $builder->generateScripts()->toHtml());
    }

    /** @test */
    public function it_can_set_table_attribute()
    {
        $builder = $this->getHtmlBuilder();

        $builder->setTableAttribute('attr', 'val');

        $this->assertEquals('val', $builder->getTableAttribute('attr'));
    }

    /** @test */
    public function it_can_set_table_id_attribute()
    {
        $builder = $this->getHtmlBuilder();

        $builder->setTableId('val');

        $this->assertEquals('val', $builder->getTableAttribute('id'));
    }

    /** @test */
    public function it_can_set_multiple_table_attributes()
    {
        $builder = $this->getHtmlBuilder();

        $builder->setTableAttribute(['prop1' => 'val1', 'prop2' => 'val2']);

        $this->assertEquals('val1', $builder->getTableAttribute('prop1'));
        $this->assertEquals('val2', $builder->getTableAttribute('prop2'));
    }

    /** @test */
    public function it_can_get_inexistent_table_attribute_throws()
    {
        $builder = $this->getHtmlBuilder();

        $attr = $builder->getTableAttribute('boohoo');

        $this->assertEmpty($attr);
    }

    /** @test */
    public function it_can_add_table_class_attribute()
    {
        $builder = $this->getHtmlBuilder();
        $this->assertEquals('table', $builder->getTableAttribute('class'));

        $builder->addTableClass('foo');
        $this->assertEquals('table foo', $builder->getTableAttribute('class'));

        $builder->addTableClass('  foo  bar  ');
        $this->assertEquals('table foo bar', $builder->getTableAttribute('class'));

        $builder->addTableClass([' a-b ', 'foo c bar', 'key' => 'value']);
        $this->assertEquals('table foo bar a-b c value', $builder->getTableAttribute('class'));
    }

    /** @test */
    public function it_can_remove_table_class_attribute()
    {
        $builder = $this->getHtmlBuilder();
        $builder->setTableAttribute('class', ' foo  bar  a  b  c ');

        $builder->removeTableClass('bar');
        $this->assertEquals('foo a b c', $builder->getTableAttribute('class'));

        $builder->removeTableClass('  x  c  y ');
        $this->assertEquals('foo a b', $builder->getTableAttribute('class'));

        $builder->removeTableClass(['a' => ' b ', ' foo  bar ']);
        $this->assertEquals('a', $builder->getTableAttribute('class'));
    }

    /** @test */
    public function it_can_add_checkbox()
    {
        $builder = $this->getHtmlBuilder();
        $builder->addCheckbox();

        $column = $builder->getColumns()[0];

        $this->assertCount(1, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $column);
        $this->assertEquals(false, $column->orderable);
        $this->assertEquals(false, $column->searchable);
        $this->assertEquals(false, $column->exportable);
        $this->assertEquals(true, $column->printable);
    }

    /** @test */
    public function it_can_add_index_column()
    {
        $builder = $this->getHtmlBuilder();
        $builder->addIndex();

        $column = $builder->getColumns()[0];

        $this->assertCount(1, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $column);
        $this->assertEquals(false, $column->orderable);
        $this->assertEquals(false, $column->searchable);
        $this->assertEquals(false, $column->exportable);
        $this->assertEquals(true, $column->printable);
    }

    /** @test */
    public function it_can_add_action_column()
    {
        $builder = $this->getHtmlBuilder();
        $builder->addAction();

        $column = $builder->getColumns()[0];

        $this->assertCount(1, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $column);
        $this->assertEquals(false, $column->orderable);
        $this->assertEquals(false, $column->searchable);
        $this->assertEquals(false, $column->exportable);
        $this->assertEquals(true, $column->printable);
    }
}
