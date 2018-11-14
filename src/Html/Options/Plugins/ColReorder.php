<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - ColReorder plugin option builder.
 *
 * @see https://datatables.net/extensions/colreorder/
 * @see https://datatables.net/reference/option/colReorder
 */
trait ColReorder
{
    /**
     * Set colReorder option value.
     * Enable and configure the AutoFill extension for DataTables.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/colReorder
     */
    public function colReorder($value)
    {
        $this->attributes['colReorder'] = $value;

        return $this;
    }
}
