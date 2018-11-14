<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - Select plugin option builder.
 *
 * @see https://datatables.net/extensions/select
 * @see https://datatables.net/reference/option/select
 */
trait Select
{
    /**
     * Set select option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/select
     */
    public function select($value = true)
    {
        $this->attributes['select'] = $value;

        return $this;
    }
}
