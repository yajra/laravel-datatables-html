<?php

namespace Yajra\DataTables\Html\Tests;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class BuilderOptionsTest extends TestCase
{
    /** @test */
    public function it_has_callbacks_options()
    {
        $builder = $this->getHtmlBuilder();

        $builder
            ->createdRow('function() {}')
            ->drawCallback('function() {}')
            ->footerCallback('function() {}')
            ->formatNumber('function() {}')
            ->headerCallback('function() {}')
            ->infoCallback('function() {}')
            ->initComplete('function() {}')
            ->preDrawCallback('function() {}')
            ->rowCallback('function() {}')
            ->stateLoadCallback('function() {}')
            ->stateLoaded('function() {}')
            ->stateLoadParams('function() {}')
            ->stateSaveCallback('function() {}')
            ->stateSaveParams('function() {}');

        $this->assertEquals('function() {}', $builder->getAttribute('createdRow'));
        $this->assertEquals('function() {}', $builder->getAttribute('drawCallback'));
        $this->assertEquals('function() {}', $builder->getAttribute('footerCallback'));
        $this->assertEquals('function() {}', $builder->getAttribute('formatNumber'));
        $this->assertEquals('function() {}', $builder->getAttribute('infoCallback'));
        $this->assertEquals('function() {}', $builder->getAttribute('preDrawCallback'));
        $this->assertEquals('function() {}', $builder->getAttribute('stateLoaded'));
        $this->assertEquals('function() {}', $builder->getAttribute('stateSaveCallback'));
        $this->assertEquals('function() {}', $builder->getAttribute('stateSaveParams'));

        $builder->drawCallbackWithLivewire();
        $this->assertStringContainsString('window.livewire.rescan()', $builder->getAttribute('drawCallback'));

        $builder->drawCallbackWithLivewire('test livewire');
        $this->assertStringContainsString('test livewire', $builder->getAttribute('drawCallback'));
    }

    /**
     * @return \Yajra\DataTables\Html\Builder
     */
    protected function getHtmlBuilder(): Builder
    {
        return app(Builder::class);
    }

    /** @test */
    public function it_has_columns_options()
    {
        $builder = $this->getHtmlBuilder();

        $builder->columnDefs(['target' => [1]])
                ->addColumnDef(['target' => [1]])
                ->addColumnDef(['target' => [2]])
                ->columns([
                    Column::make('id'),
                    Column::make('name'),
                ]);

        $this->assertEquals([1], $builder->getAttribute('columnDefs')['target']);
        $this->assertEquals([1], $builder->getAttribute('columnDefs')[0]['target']);
        $this->assertEquals([2], $builder->getAttribute('columnDefs')[1]['target']);
        $this->assertCount(2, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $builder->getColumns()[0]);
        $this->assertEquals('id', $builder->getColumns()[0]['data']);
        $this->assertEquals('id', $builder->getColumns()[0]['name']);
        $this->assertEquals('Id', $builder->getColumns()[0]['title']);

        $builder->addColumn(['data' => 'email']);

        $this->assertCount(3, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $builder->getColumns()[2]);
        $this->assertEquals('email', $builder->getColumns()[2]['data']);
        $this->assertEquals('email', $builder->getColumns()[2]['name']);
        $this->assertEquals('Email', $builder->getColumns()[2]['title']);

        $builder->addColumn(Column::make('created_at'));

        $this->assertCount(4, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $builder->getColumns()[3]);
        $this->assertEquals('created_at', $builder->getColumns()[3]['data']);
        $this->assertEquals('created_at', $builder->getColumns()[3]['name']);
        $this->assertEquals('Created At', $builder->getColumns()[3]['title']);

        $builder->addColumnBefore(['data' => 'updated_at']);

        $this->assertCount(5, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $builder->getColumns()[0]);
        $this->assertEquals('updated_at', $builder->getColumns()[0]['data']);
        $this->assertEquals('updated_at', $builder->getColumns()[0]['name']);
        $this->assertEquals('Updated At', $builder->getColumns()[0]['title']);

        $builder->addBefore(Column::make('deleted_at'));

        $this->assertCount(6, $builder->getColumns());
        $this->assertInstanceOf(Column::class, $builder->getColumns()[0]);
        $this->assertEquals('deleted_at', $builder->getColumns()[0]['data']);
        $this->assertEquals('deleted_at', $builder->getColumns()[0]['name']);
        $this->assertEquals('Deleted At', $builder->getColumns()[0]['title']);

        $builder->removeColumn('created_at', 'updated_at');
        $this->assertCount(4, $builder->getColumns());
    }

    /** @test */
    public function it_has_ajax_options()
    {
        $builder = $this->getHtmlBuilder();

        $builder->postAjax('/test');

        $this->assertEquals('/test', $builder->getAjaxUrl());
        $this->assertEquals([
            "url" => "/test",
            "type" => "POST",
            "headers" => [
                "X-HTTP-Method-Override" => "GET",
            ],
        ], $builder->getAjax());

        $builder->ajax('/test');
        $this->assertEquals('/test', $builder->getAjaxUrl());

        $builder->ajax(['url' => '/test']);
        $this->assertEquals('/test', $builder->getAjax('url'));

        $builder->pipeline('/test');
        $this->assertEquals("$.fn.dataTable.pipeline({ url: '/test', pages: 5 })", $builder->getAjaxUrl());

        $builder->pipeline('/test', 6);
        $this->assertEquals("$.fn.dataTable.pipeline({ url: '/test', pages: 6 })", $builder->getAjaxUrl());

        $builder->ajaxWithForm('/test', '#formId');
        $this->assertStringContainsString('data.columns.length', $builder->getAjax()['data']);
        $this->assertStringContainsString('delete data.columns[i].search;', $builder->getAjax('data'));
        $this->assertStringContainsString('#formId', $builder->getAjax('data'));

        $builder->minifiedAjax('/test', 'custom_script', ['id' => 123, 'name' => 'yajra']);
        $this->assertEquals('/test', $builder->getAjax('url'));
        $this->assertStringContainsString('custom_script', $builder->getAjax('data'));
        $this->assertStringContainsString("data.id = 123", $builder->getAjax('data'));
        $this->assertStringContainsString("data.name = 'yajra'", $builder->getAjax('data'));
    }
}
