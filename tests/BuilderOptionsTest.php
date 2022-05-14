<?php

namespace Yajra\DataTables\Html\Tests;

use Yajra\DataTables\Html\Builder;

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
}
