<?php

namespace Yajra\DataTables\Html;

/**
 * DataTables - Features option builder.
 *
 * @see https://datatables.net/reference/option/
 */
trait HasDataTablesFeaturesOptions
{
    /**
     * Set autoWidth option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/autoWidth
     */
    public function autoWidth(bool $value = true)
    {
        $this->attributes['autoWidth'] = $value;

        return $this;
    }

    /**
     * Set deferRender option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/deferRender
     */
    public function deferRender(bool $value = true)
    {
        $this->attributes['deferRender'] = $value;

        return $this;
    }

    /**
     * Set info option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/info
     */
    public function info(bool $value = true)
    {
        $this->attributes['info'] = $value;

        return $this;
    }

    /**
     * Set lengthChange option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/lengthChange
     */
    public function lengthChange(bool $value = true)
    {
        $this->attributes['lengthChange'] = $value;

        return $this;
    }

    /**
     * Set ordering option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/ordering
     */
    public function ordering(bool $value = true)
    {
        $this->attributes['ordering'] = $value;

        return $this;
    }

    /**
     * Set processing option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/processing
     */
    public function processing(bool $value = true)
    {
        $this->attributes['processing'] = $value;

        return $this;
    }

    /**
     * Set scrollX option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/scrollX
     */
    public function scrollX(bool $value = true)
    {
        $this->attributes['scrollX'] = $value;

        return $this;
    }

    /**
     * Set scrollY option value.
     *
     * @param bool|mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/scrollY
     */
    public function scrollY($value = true)
    {
        $this->attributes['scrollY'] = $value;

        return $this;
    }

    /**
     * Set paging option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/paging
     */
    public function paging(bool $value = true)
    {
        $this->attributes['paging'] = $value;

        return $this;
    }

    /**
     * Set searching option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/searching
     */
    public function searching(bool $value = true)
    {
        $this->attributes['searching'] = $value;

        return $this;
    }

    /**
     * Set serverSide option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/serverSide
     */
    public function serverSide(bool $value = true)
    {
        $this->attributes['serverSide'] = $value;

        return $this;
    }

    /**
     * Set stateSave option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/stateSave
     */
    public function stateSave(bool $value = true)
    {
        $this->attributes['stateSave'] = $value;

        return $this;
    }
}
