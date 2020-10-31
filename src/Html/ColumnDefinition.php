<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;

class ColumnDefinition extends Fluent
{
    use HasOptions;

    public function targets($value)
    {
        $this->attributes['targets'] = (array) $value;

        return $this;
    }
}
