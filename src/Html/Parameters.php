<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;

/**
 * @property bool serverSide
 * @property bool processing
 * @property mixed ajax
 * @property array columns
 */
class Parameters extends Fluent
{
    /**
     * @var array
     */
    protected $attributes = [
        'serverSide' => true,
        'processing' => true,
        'ajax'       => '',
        'columns'    => [],
    ];
}
