<?php

namespace Yajra\DataTables\Html\Tests\TestComponents;

use Livewire\Component;

class TestLivewire extends Component
{
    public function render(): string
    {
        return <<<'blade'
            <div>test livewire</div>
        blade;
    }
}
