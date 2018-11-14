<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - RowReorder plugin option builder.
 *
 * @see https://datatables.net/extensions/rowreorder
 * @see https://datatables.net/reference/option/rowReorder
 */
trait RowReorder
{
    /**
     * Set rowReorder option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/rowReorder
     */
    public function rowReorder($value)
    {
        $this->attributes['rowReorder'] = $value;

        return $this;
    }
}
