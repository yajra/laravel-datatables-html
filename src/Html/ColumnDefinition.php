<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

class ColumnDefinition extends Fluent
{
    use HasOptions;

    /**
     * TODO: Review HasColumns have collection and is not applicable here.
     * @var \Illuminate\Support\Collection
     */
    protected Collection $collection;

    public function targets(array $value): static
    {
        $this->attributes['targets'] = $value;

        return $this;
    }
}
