<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - Scroller plugin option builder.
 *
 * @see https://datatables.net/extensions/scroller
 * @see https://datatables.net/reference/option/scroller
 */
trait Scroller
{
    /**
     * Set scroller option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller
     */
    public function scroller($value = true)
    {
        $this->attributes['scroller'] = $value;

        return $this;
    }
}
