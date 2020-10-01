<?php

namespace Yajra\DataTables\Html\Options\Plugins;

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
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/searchPanes
     */
    public function searchPanes($value = true)
    {
        if ($value instanceof SearchPane) {
            $this->attributes['searchPane'] = $value->toArray();
        } else {
            $this->attributes['searchPane'] = $value;
        }

        return $this;
    }
}
