<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;

class Parameters extends Fluent
{
    /**
     * @var array<string, mixed>
     */
    protected $attributes = [
        'serverSide' => true,
        'processing' => true,
        'ajax' => '',
        'columns' => [],
    ];
}
