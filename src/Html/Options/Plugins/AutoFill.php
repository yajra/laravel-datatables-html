<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - AutoFill plugin option builder.
 *
 * @see https://datatables.net/extensions/autoFill/
 * @see https://datatables.net/reference/option/autoFill
 */
trait AutoFill
{
    /**
     * Set autoFill option value.
     * Enable and configure the AutoFill extension for DataTables.
     *
     * @param string|array $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill
     */
    public function autoFill($value)
    {
        $this->attributes['autoFill'] = $value;

        return $this;
    }
}
