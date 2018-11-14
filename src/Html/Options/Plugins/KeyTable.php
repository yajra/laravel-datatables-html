<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - KeyTable plugin option builder.
 *
 * @see https://datatables.net/extensions/keytable/
 * @see https://datatables.net/reference/option/keys
 */
trait KeyTable
{
    /**
     * Set keys option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/keys
     */
    public function keys($value)
    {
        $this->attributes['keys'] = $value;

        return $this;
    }
}
