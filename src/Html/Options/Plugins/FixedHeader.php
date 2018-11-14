<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - FixedHeader plugin option builder.
 *
 * @see https://datatables.net/extensions/fixedheader/
 * @see https://datatables.net/reference/option/fixedHeader
 */
trait FixedHeader
{
    /**
     * Set fixedHeader option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedHeader
     */
    public function fixedHeader($value = true)
    {
        $this->attributes['fixedHeader'] = $value;

        return $this;
    }
}
