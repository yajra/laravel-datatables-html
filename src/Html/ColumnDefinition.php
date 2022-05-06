<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;

class ColumnDefinition extends Fluent
{
    use HasOptions;

    public function targets(array $value): self
    {
        $this->attributes['targets'] = $value;

        return $this;
    }
}
