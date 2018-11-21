<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - FixedColumns plugin option builder.
 *
 * @see https://datatables.net/extensions/fixedcolumns/
 * @see https://datatables.net/reference/option/fixedColumns
 * @see https://datatables.net/reference/option/#fixedColumns
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

    /**
     * Set fixedColumns heightMatch option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedColumns.heightMatch
     */
    public function fixedColumnsHeightMatch($value = 'semiauto')
    {
        $this->attributes['fixedColumns']['heightMatch'] = $value;

        return $this;
    }

    /**
     * Set fixedColumns leftColumns option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedColumns.leftColumns
     */
    public function fixedColumnsLeftColumns(int $value = 1)
    {
        $this->attributes['fixedColumns']['leftColumns'] = $value;

        return $this;
    }

    /**
     * Set fixedColumns rightColumns option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedColumns.rightColumns
     */
    public function fixedColumnsRightColumns(int $value = 0)
    {
        $this->attributes['fixedColumns']['rightColumns'] = $value;

        return $this;
    }
}
