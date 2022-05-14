<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;

// TODO: Review class implementation
class ColumnDefinition extends Fluent
{
    public function targets(array $value): static
    {
        $this->attributes['targets'] = $value;

        return $this;
    }
}
