<?php

use PHPUnit\Framework\TestCase;
use Yajra\DataTables\Factory;
use Yajra\DataTables\Html\Column;

require_once 'helper.php';

class HtmlBuilderTest extends TestCase
{
    public function test_generate_table_html()
    {
        $builder = $this->getHtmlBuilder([
            'class' => 'table',
            'id'    => 'dataTableBuilder',
        ]);

        $builder->html->shouldReceive('attributes')->times(8)->andReturn('id="foo"');

        $builder->columns(['foo', 'bar' => ['data' => 'foo']])
                ->addCheckbox(['id' => 'foo'])
                ->addColumn(['name' => 'id', 'data' => 'id', 'title' => 'Id'])
                ->add(new Column(['name' => 'a', 'data' => 'a', 'title' => 'A']))
                ->addAction(['title' => 'Options'])
                ->ajax('ajax-url')
                ->parameters(['bFilter' => false]);
        $table    = $builder->table(['id' => 'foo'])->toHtml();
        $expected = '<table id="foo"><thead><tr><th id="foo">Foo</th><th id="foo">Bar</th><th id="foo"><input type="checkbox" id="foo"/></th><th id="foo">Id</th><th id="foo">A</th><th id="foo">Options</th></tr></thead></table>';
        $this->assertEquals($expected, $table);

        $builder->view->shouldReceive('make')->times(2)->andReturn($builder->view);
        $builder->config->shouldReceive('get')->times(2)->andReturn('datatables::script');
        $template = file_get_contents(__DIR__ . '/../src/resources/views/script.blade.php');
        $builder->view->shouldReceive('render')->times(2)->andReturn(trim($template));
        $builder->html->shouldReceive('attributes')->once()->andReturn();

        $script   = $builder->scripts()->toHtml();
        $expected = '<script>(function(window,$){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["foo"]=$("#foo").DataTable({"serverSide":true,"processing":true,"ajax":"ajax-url","columns":[{"name":"foo","data":"foo","title":"Foo","orderable":true,"searchable":true},{"name":"bar","data":"foo","title":"Bar","orderable":true,"searchable":true},{"defaultContent":"<input type=\"checkbox\" id=\"foo\"\/>","title":"<input type=\"checkbox\" id=\"foo\"\/>","data":"checkbox","name":"checkbox","orderable":false,"searchable":false,"width":"10px","id":"foo"},{"name":"id","data":"id","title":"Id","orderable":true,"searchable":true},{"name":"a","data":"a","title":"A","orderable":true,"searchable":true},{"defaultContent":"","data":"action","name":"action","title":"Options","render":null,"orderable":false,"searchable":false}],"bFilter":false});})(window,jQuery);</script>' . PHP_EOL;
        $this->assertEquals($expected, $script);

        $expected = '(function(window,$){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["foo"]=$("#foo").DataTable({"serverSide":true,"processing":true,"ajax":"ajax-url","columns":[{"name":"foo","data":"foo","title":"Foo","orderable":true,"searchable":true},{"name":"bar","data":"foo","title":"Bar","orderable":true,"searchable":true},{"defaultContent":"<input type=\"checkbox\" id=\"foo\"\/>","title":"<input type=\"checkbox\" id=\"foo\"\/>","data":"checkbox","name":"checkbox","orderable":false,"searchable":false,"width":"10px","id":"foo"},{"name":"id","data":"id","title":"Id","orderable":true,"searchable":true},{"name":"a","data":"a","title":"A","orderable":true,"searchable":true},{"defaultContent":"","data":"action","name":"action","title":"Options","render":null,"orderable":false,"searchable":false}],"bFilter":false});})(window,jQuery);';
        $this->assertEquals($expected, $builder->generateScripts()->toHtml());
    }

    /**
     * @return \Mockery\MockInterface|\Yajra\DataTables\Html\Builder
     */
    protected function getHtmlBuilder($config = [])
    {
        $builder = app('datatables.html', $config);

        return $builder;
    }

    public function test_generate_table_html_with_empty_footer()
    {
        $builder = $this->getHtmlBuilder([
            'class' => 'table',
            'id'    => 'dataTableBuilder',
        ]);
        $builder->html->shouldReceive('attributes')->times(8)->andReturn('id="foo"');

        $builder->columns(['foo', 'bar' => ['data' => 'foo']])
                ->addCheckbox(['id' => 'foo'])
                ->addColumn(['name' => 'id', 'data' => 'id', 'title' => 'Id'])
                ->add(new Column(['name' => 'a', 'data' => 'a', 'title' => 'A']))
                ->addAction(['title' => 'Options'])
                ->ajax('ajax-url')
                ->parameters(['bFilter' => false]);
        $table    = $builder->table(['id' => 'foo'], true)->toHtml();
        $expected = '<table id="foo"><thead><tr><th id="foo">Foo</th><th id="foo">Bar</th><th id="foo"><input type="checkbox" id="foo"/></th><th id="foo">Id</th><th id="foo">A</th><th id="foo">Options</th></tr></thead><tfoot><tr><th></th><th></th><th></th><th></th><th></th><th></th></tr></tfoot></table>';
        $this->assertEquals($expected, $table);

        $builder->view->shouldReceive('make')->times(2)->andReturn($builder->view);
        $builder->config->shouldReceive('get')->times(2)->andReturn('datatables::script');
        $template = file_get_contents(__DIR__ . '/../src/resources/views/script.blade.php');
        $builder->view->shouldReceive('render')->times(2)->andReturn(trim($template));
        $builder->html->shouldReceive('attributes')->once()->andReturn();

        $script   = $builder->scripts()->toHtml();
        $expected = '<script>(function(window,$){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["foo"]=$("#foo").DataTable({"serverSide":true,"processing":true,"ajax":"ajax-url","columns":[{"name":"foo","data":"foo","title":"Foo","orderable":true,"searchable":true},{"name":"bar","data":"foo","title":"Bar","orderable":true,"searchable":true},{"defaultContent":"<input type=\"checkbox\" id=\"foo\"\/>","title":"<input type=\"checkbox\" id=\"foo\"\/>","data":"checkbox","name":"checkbox","orderable":false,"searchable":false,"width":"10px","id":"foo"},{"name":"id","data":"id","title":"Id","orderable":true,"searchable":true},{"name":"a","data":"a","title":"A","orderable":true,"searchable":true},{"defaultContent":"","data":"action","name":"action","title":"Options","render":null,"orderable":false,"searchable":false}],"bFilter":false});})(window,jQuery);</script>' . PHP_EOL;
        $this->assertEquals($expected, $script);

        $expected = '(function(window,$){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["foo"]=$("#foo").DataTable({"serverSide":true,"processing":true,"ajax":"ajax-url","columns":[{"name":"foo","data":"foo","title":"Foo","orderable":true,"searchable":true},{"name":"bar","data":"foo","title":"Bar","orderable":true,"searchable":true},{"defaultContent":"<input type=\"checkbox\" id=\"foo\"\/>","title":"<input type=\"checkbox\" id=\"foo\"\/>","data":"checkbox","name":"checkbox","orderable":false,"searchable":false,"width":"10px","id":"foo"},{"name":"id","data":"id","title":"Id","orderable":true,"searchable":true},{"name":"a","data":"a","title":"A","orderable":true,"searchable":true},{"defaultContent":"","data":"action","name":"action","title":"Options","render":null,"orderable":false,"searchable":false}],"bFilter":false});})(window,jQuery);';
        $this->assertEquals($expected, $builder->generateScripts()->toHtml());
    }

    public function test_generate_table_html_with_footer_content()
    {
        $builder = $this->getHtmlBuilder([
            'class' => 'table',
            'id'    => 'dataTableBuilder',
        ]);
        $builder->html->shouldReceive('attributes')->times(8)->andReturn('id="foo"');

        $builder->columns(['foo', 'bar' => ['data' => 'foo']])
                ->addCheckbox(['id' => 'foo', 'footer' => 'test'])
                ->addColumn(['name' => 'id', 'data' => 'id', 'title' => 'Id'])
                ->add(new Column(['name' => 'a', 'data' => 'a', 'title' => 'A']))
                ->addAction(['title' => 'Options'])
                ->ajax('ajax-url')
                ->parameters(['bFilter' => false]);
        $table    = $builder->table(['id' => 'foo'], true)->toHtml();
        $expected = '<table id="foo"><thead><tr><th id="foo">Foo</th><th id="foo">Bar</th><th id="foo"><input type="checkbox" id="foo"/></th><th id="foo">Id</th><th id="foo">A</th><th id="foo">Options</th></tr></thead><tfoot><tr><th></th><th></th><th>test</th><th></th><th></th><th></th></tr></tfoot></table>';
        $this->assertEquals($expected, $table);

        $builder->view->shouldReceive('make')->times(2)->andReturn($builder->view);
        $builder->config->shouldReceive('get')->times(2)->andReturn('datatables::script');
        $template = file_get_contents(__DIR__ . '/../src/resources/views/script.blade.php');
        $builder->view->shouldReceive('render')->times(2)->andReturn(trim($template));
        $builder->html->shouldReceive('attributes')->once()->andReturn();

        $script   = $builder->scripts()->toHtml();
        $expected = '<script>(function(window,$){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["foo"]=$("#foo").DataTable({"serverSide":true,"processing":true,"ajax":"ajax-url","columns":[{"name":"foo","data":"foo","title":"Foo","orderable":true,"searchable":true},{"name":"bar","data":"foo","title":"Bar","orderable":true,"searchable":true},{"defaultContent":"<input type=\"checkbox\" id=\"foo\"\/>","title":"<input type=\"checkbox\" id=\"foo\"\/>","data":"checkbox","name":"checkbox","orderable":false,"searchable":false,"width":"10px","id":"foo"},{"name":"id","data":"id","title":"Id","orderable":true,"searchable":true},{"name":"a","data":"a","title":"A","orderable":true,"searchable":true},{"defaultContent":"","data":"action","name":"action","title":"Options","render":null,"orderable":false,"searchable":false}],"bFilter":false});})(window,jQuery);</script>' . PHP_EOL;
        $this->assertEquals($expected, $script);

        $expected = '(function(window,$){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["foo"]=$("#foo").DataTable({"serverSide":true,"processing":true,"ajax":"ajax-url","columns":[{"name":"foo","data":"foo","title":"Foo","orderable":true,"searchable":true},{"name":"bar","data":"foo","title":"Bar","orderable":true,"searchable":true},{"defaultContent":"<input type=\"checkbox\" id=\"foo\"\/>","title":"<input type=\"checkbox\" id=\"foo\"\/>","data":"checkbox","name":"checkbox","orderable":false,"searchable":false,"width":"10px","id":"foo"},{"name":"id","data":"id","title":"Id","orderable":true,"searchable":true},{"name":"a","data":"a","title":"A","orderable":true,"searchable":true},{"defaultContent":"","data":"action","name":"action","title":"Options","render":null,"orderable":false,"searchable":false}],"bFilter":false});})(window,jQuery);';
        $this->assertEquals($expected, $builder->generateScripts()->toHtml());
    }

    public function test_setting_table_attribute()
    {
        $builder = $this->getHtmlBuilder();

        $builder->setTableAttribute('attr', 'val');

        $this->assertEquals('val', $builder->getTableAttribute('attr'));
    }

    public function test_setting_table_id_attribute()
    {
        $builder = $this->getHtmlBuilder();

        $builder->setTableId('val');

        $this->assertEquals('val', $builder->getTableAttribute('id'));
    }

    public function test_settings_multiple_table_attributes()
    {
        $builder = $this->getHtmlBuilder();

        $builder->setTableAttribute(['prop1' => 'val1', 'prop2' => 'val2']);

        $this->assertEquals('val1', $builder->getTableAttribute('prop1'));
        $this->assertEquals('val2', $builder->getTableAttribute('prop2'));
    }

    public function test_getting_inexistent_table_attribute_throws()
    {
        $this->expectExceptionMessage('Table attribute \'boohoo\' does not exist.');

        $builder = $this->getHtmlBuilder();

        $builder->getTableAttribute('boohoo');
    }

    public function test_adding_table_class_attribute()
    {
        $builder = $this->getHtmlBuilder();

        $builder->addTableClass('foo');
        $this->assertEquals('foo', $builder->getTableAttribute('class'));

        $builder->addTableClass('  foo  bar  ');
        $this->assertEquals('foo bar', $builder->getTableAttribute('class'));

        $builder->addTableClass([' a-b ', 'foo c bar', 'key' => 'value']);
        $this->assertEquals('foo bar a-b c value', $builder->getTableAttribute('class'));
    }

    public function test_removing_table_class_attribute()
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

    /**
     * @return \Yajra\DataTables\Factory
     */
    protected function getDataTables()
    {
        $factory = new Factory;

        return $factory;
    }
}
