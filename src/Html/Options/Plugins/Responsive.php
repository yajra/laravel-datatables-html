<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - Responsive plugin option builder.
 *
 * @see https://datatables.net/extensions/responsive
 * @see https://datatables.net/reference/option/responsive
 */
trait Responsive
{
    /**
     * Set responsive option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive
     */
    public function responsive($value = true)
    {
        $this->attributes['responsive'] = $value;

        return $this;
    }
}
