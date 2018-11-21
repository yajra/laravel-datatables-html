<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - AutoFill plugin option builder.
 *
 * @see https://datatables.net/extensions/autofill/
 * @see https://datatables.net/reference/option/autoFill
 * @see https://datatables.net/reference/option/#autoFill
 */
trait AutoFill
{
    /**
     * Set autoFill option value.
     * Enable and configure the AutoFill extension for DataTables.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill
     */
    public function autoFill($value = true)
    {
        $this->attributes['autoFill'] = $value;

        return $this;
    }

    /**
     * Set autoFill alwaysAsk option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.alwaysAsk
     */
    public function autoFillAlwaysAsk(bool $value = true)
    {
        $this->attributes['autoFill']['alwaysAsk'] = $value;

        return $this;
    }

    /**
     * Set autoFill columns option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.columns
     */
    public function autoFillColumns($value)
    {
        $this->attributes['autoFill']['columns'] = $value;

        return $this;
    }

    /**
     * Set autoFill editor option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.editor
     */
    public function autoFillEditor($value)
    {
        $this->attributes['autoFill']['editor'] = $value;

        return $this;
    }

    /**
     * Set autoFill enable option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.enable
     */
    public function autoFillEnable(bool $value = true)
    {
        $this->attributes['autoFill']['enable'] = $value;

        return $this;
    }

    /**
     * Set autoFill focus option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.focus
     */
    public function autoFillFocus($value = null)
    {
        $this->attributes['autoFill']['focus'] = $value;

        return $this;
    }

    /**
     * Set autoFill horizontal option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.horizontal
     */
    public function autoFillHorizontal(bool $value = true)
    {
        $this->attributes['autoFill']['horizontal'] = $value;

        return $this;
    }

    /**
     * Set autoFill update option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.update
     */
    public function autoFillUpdate(bool $value = true)
    {
        $this->attributes['autoFill']['update'] = $value;

        return $this;
    }

    /**
     * Set autoFill vertical option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.vertical
     */
    public function autoFillVertical(bool $value = true)
    {
        $this->attributes['autoFill']['vertical'] = $value;

        return $this;
    }
}
