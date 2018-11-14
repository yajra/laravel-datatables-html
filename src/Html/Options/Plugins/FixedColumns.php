<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - FixedColumns plugin option builder.
 *
 * @see https://datatables.net/extensions/fixedcolumns/
 * @see https://datatables.net/reference/option/fixedColumns
 */
trait FixedColumns
{
    /**
     * Set fixedColumns option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedColumns
     */
    public function fixedColumns($value = true)
    {
        $this->attributes['fixedColumns'] = $value;

        return $this;
    }
}
