<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - ColReorder plugin option builder.
 *
 * @see https://datatables.net/extensions/colreorder/
 * @see https://datatables.net/reference/option/colReorder
 * @see https://datatables.net/reference/option/#colReorder
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
    public function colReorder($value = true)
    {
        $this->attributes['colReorder'] = $value;

        return $this;
    }

    /**
     * Set colReorder enable option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/colReorder.enable
     */
    public function colReorderEnable(bool $value = true)
    {
        $this->attributes['colReorder']['enable'] = $value;

        return $this;
    }

    /**
     * Set colReorder fixedColumnsLeft option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/colReorder.fixedColumnsLeft
     */
    public function colReorderFixedColumnsLeft(int $value = 0)
    {
        $this->attributes['colReorder']['fixedColumnsLeft'] = $value;

        return $this;
    }

    /**
     * Set colReorder fixedColumnsRight option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/colReorder.fixedColumnsRight
     */
    public function colReorderFixedColumnsRight(int $value = 0)
    {
        $this->attributes['colReorder']['fixedColumnsRight'] = $value;

        return $this;
    }

    /**
     * Set colReorder order option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/colReorder.order
     */
    public function colReorderOrder(array $value = [])
    {
        $this->attributes['colReorder']['order'] = $value;

        return $this;
    }

    /**
     * Set colReorder realtime option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/colReorder.realtime
     */
    public function colReorderRealtime(bool $value = true)
    {
        $this->attributes['colReorder']['realtime'] = $value;

        return $this;
    }
}
