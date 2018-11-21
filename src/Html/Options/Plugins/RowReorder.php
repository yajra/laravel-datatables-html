<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - RowReorder plugin option builder.
 *
 * @see https://datatables.net/extensions/rowreorder
 * @see https://datatables.net/reference/option/rowReorder
 * @see https://datatables.net/reference/option/#rowReorder
 */
trait RowReorder
{
    /**
     * Set rowReorder option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/rowReorder
     */
    public function rowReorder($value = true)
    {
        $this->attributes['rowReorder'] = $value;

        return $this;
    }

    /**
     * Set rowReorder dataSrc option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/rowReorder.dataSrc
     */
    public function rowReorderDataSrc($value = 0)
    {
        $this->attributes['rowReorder']['dataSrc'] = $value;

        return $this;
    }

    /**
     * Set rowReorder editor option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/rowReorder.editor
     */
    public function rowReorderEditor($value = null)
    {
        $this->attributes['rowReorder']['editor'] = $value;

        return $this;
    }

    /**
     * Set rowReorder enable option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/rowReorder.enable
     */
    public function rowReorderEnable(bool $value = true)
    {
        $this->attributes['rowReorder']['enable'] = $value;

        return $this;
    }

    /**
     * Set rowReorder formOptions option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/rowReorder.formOptions
     */
    public function rowReorderFormOptions($value)
    {
        $this->attributes['rowReorder']['formOptions'] = $value;

        return $this;
    }

    /**
     * Set rowReorder selector option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/rowReorder.selector
     */
    public function rowReorderSelector($value = 'td:first-child')
    {
        $this->attributes['rowReorder']['selector'] = $value;

        return $this;
    }

    /**
     * Set rowReorder snapX option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/rowReorder.snapX
     */
    public function rowReorderSnapX($value = true)
    {
        $this->attributes['rowReorder']['snapX'] = $value;

        return $this;
    }

    /**
     * Set rowReorder update option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/rowReorder.update
     */
    public function rowReorderUpdate(bool $value = true)
    {
        $this->attributes['rowReorder']['update'] = $value;

        return $this;
    }
}
