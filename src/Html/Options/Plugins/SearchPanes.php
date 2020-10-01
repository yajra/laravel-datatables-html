<?php

namespace Yajra\DataTables\Html\Options\Plugins;

use Illuminate\Contracts\Support\Arrayable;

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
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/searchPanes
     */
    public function searchPanes($value = true)
    {
        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        }

        $this->attributes['searchPanes'] = $value;

        return $this;
    }
}
