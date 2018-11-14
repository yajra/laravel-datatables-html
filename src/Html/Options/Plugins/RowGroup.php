<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - RowGroup plugin option builder.
 *
 * @see https://datatables.net/extensions/rowgroup
 * @see https://datatables.net/reference/option/rowGroup
 */
trait RowGroup
{
    /**
     * Set rowGroup option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup
     */
    public function rowGroup($value)
    {
        $this->attributes['rowGroup'] = $value;

        return $this;
    }
}
