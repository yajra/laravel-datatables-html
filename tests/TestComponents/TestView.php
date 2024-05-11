<?php

namespace Yajra\DataTables\Html\Tests\TestComponents;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class TestView extends Component
{
    public function render(): Renderable
    {
        return view('test-view');
    }
}
