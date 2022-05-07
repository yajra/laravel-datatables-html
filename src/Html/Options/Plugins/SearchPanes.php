<?php

namespace Yajra\DataTables\Html\Options\Plugins;

use Illuminate\Contracts\Support\Arrayable;
use Yajra\DataTables\Html\SearchPane;

/**
 * DataTables - Search panes plugin option builder.
 *
 * @see https://datatables.net/extensions/searchpanes
 * @see https://datatables.net/reference/option/searchPanes
 */
trait SearchPanes
{
    /**
     * Set searchPane option value.
     *
     * @param  bool|array  $value
     * @return $this
     * @see https://datatables.net/reference/option/searchPanes
     */
    public function searchPanes(bool|array $value = true): static
    {
        if (is_callable($value)) {
            $value = app()->call($value);
        }

        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        }

        if (is_bool($value)) {
            $value = SearchPane::make()->show($value)->toArray();
        }

        $this->attributes['searchPanes'] = $value;

        return $this;
    }
}
