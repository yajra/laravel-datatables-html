<?php

namespace Yajra\DataTables\Html\Tests\TestComponents;

use Illuminate\View\Component;

class TestInlineView extends Component
{
    public function render(): string
    {
        return <<<'blade'
        <p>Test Inline View</p>
        blade;
    }
}
