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
     * Set rowGroup className option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.className
     */
    public function rowGroupUpdate(string $value = 'group'): static
    {
        return $this->rowGroup(['className' => $value]);
    }

    /**
     * Set rowGroup option value.
     *
     * @param  array|bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup
     */
    public function rowGroup(array|bool $value = true): static
    {
        return $this->setPluginAttribute('rowGroup', $value);
    }

    /**
     * Set rowGroup dataSrc option value.
     *
     * @param  array|int|string  $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.dataSrc
     */
    public function rowGroupDataSrc(array|int|string $value = 0): static
    {
        return $this->rowGroup(['dataSrc' => $value]);
    }

    /**
     * Set rowGroup emptyDataGroup option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.emptyDataGroup
     */
    public function rowGroupEmptyDataGroup(string $value = 'No Group'): static
    {
        return $this->rowGroup(['emptyDataGroup' => $value]);
    }

    /**
     * Set rowGroup enable option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.enable
     */
    public function rowGroupEnable(bool $value = true): static
    {
        return $this->rowGroup(['enable' => $value]);
    }

    /**
     * Set rowGroup endClassName option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.endClassName
     */
    public function rowGroupEndClassName(string $value = 'group-end'): static
    {
        return $this->rowGroup(['endClassName' => $value]);
    }

    /**
     * Set rowGroup endRender option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.endRender
     */
    public function rowGroupEndRender(string $value): static
    {
        return $this->rowGroup(['endRender' => $value]);
    }

    /**
     * Set rowGroup startClassName option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.startClassName
     */
    public function rowGroupStartClassName(string $value = 'group-start'): static
    {
        return $this->rowGroup(['startClassName' => $value]);
    }

    /**
     * Set rowGroup startRender option value.
     *
     * @param  string|null  $value
     * @return $this
     * @see https://datatables.net/reference/option/rowGroup.startRender
     */
    public function rowGroupStartRender(string $value = null): static
    {
        return $this->rowGroup(['startRender' => $value]);
    }

    /**
     * @param  string|null  $key
     * @return mixed
     */
    public function getRowGroup(string $key = null): mixed
    {
        if (is_null($key)) {
            return $this->attributes['rowGroup'] ?? true;
        }

        return $this->attributes['rowGroup'][$key] ?? false;
    }
}
