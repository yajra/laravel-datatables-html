<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - RowGroup plugin option builder.
 *
 * @see https://datatables.net/extensions/rowgroup
 * @see https://datatables.net/reference/option/rowGroup
 * @see https://datatables.net/reference/option/#rowGroup
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
    public function rowGroup($value = true)
    {
        $this->attributes['rowGroup'] = $value;

        return $this;
    }

    /**
     * Set rowGroup className option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.className
     */
    public function rowGroupUpdate($value = 'group')
    {
        $this->attributes['rowGroup']['className'] = $value;

        return $this;
    }

    /**
     * Set rowGroup dataSrc option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.dataSrc
     */
    public function rowGroupDataSrc($value = 0)
    {
        $this->attributes['rowGroup']['dataSrc'] = $value;

        return $this;
    }

    /**
     * Set rowGroup emptyDataGroup option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.emptyDataGroup
     */
    public function rowGroupEmptyDataGroup($value = 'No Group')
    {
        $this->attributes['rowGroup']['emptyDataGroup'] = $value;

        return $this;
    }

    /**
     * Set rowGroup enable option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.enable
     */
    public function rowGroupEnable(bool $value = true)
    {
        $this->attributes['rowGroup']['enable'] = $value;

        return $this;
    }

    /**
     * Set rowGroup endClassName option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.endClassName
     */
    public function rowGroupEndClassName($value = 'group-end')
    {
        $this->attributes['rowGroup']['endClassName'] = $value;

        return $this;
    }

    /**
     * Set rowGroup endRender option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.endRender
     */
    public function rowGroupEndRender($value)
    {
        $this->attributes['rowGroup']['endRender'] = $value;

        return $this;
    }

    /**
     * Set rowGroup startClassName option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.startClassName
     */
    public function rowGroupStartClassName($value = 'group-start')
    {
        $this->attributes['rowGroup']['startClassName'] = $value;

        return $this;
    }

    /**
     * Set rowGroup startRender option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.startRender
     */
    public function rowGroupStartRender($value)
    {
        $this->attributes['rowGroup']['startRender'] = $value;

        return $this;
    }
}
