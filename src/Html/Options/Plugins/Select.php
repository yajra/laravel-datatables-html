<?php

namespace Yajra\DataTables\Html\Options\Plugins;

use Yajra\DataTables\Html\Builder;

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
     * @param  bool|array  $value
     * @return $this
     * @see https://datatables.net/reference/option/select
     */
    public function select(bool|array $value = true): static
    {
        $this->attributes['select'] = $value;

        return $this;
    }

    /**
     * Set select blurable option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/select.blurable
     */
    public function selectBlurable(bool $value = true): static
    {
        $this->attributes['select']['blurable'] = $value;

        return $this;
    }

    /**
     * Set select className option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/select.className
     */
    public function selectClassName(string $value = 'selected'): static
    {
        $this->attributes['select']['className'] = $value;

        return $this;
    }

    /**
     * Append a class name to className option value.
     *
     * @param  string  $class
     * @return $this
     */
    public function selectAddClassName(string $class): static
    {
        if (! isset($this->attributes['select']['className'])) {
            $this->attributes['select']['className'] = $class;
        } else {
            $this->attributes['select']['className'] .= " $class";
        }

        return $this;
    }

    /**
     * Set select info option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/select.info
     */
    public function selectInfo(bool $value = true): static
    {
        $this->attributes['select']['info'] = $value;

        return $this;
    }

    /**
     * Set select items option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/select.items
     */
    public function selectItems(string $value = 'row'): static
    {
        $this->attributes['select']['items'] = $value;

        return $this;
    }

    /**
     * Set select items option value to row.
     *
     * @return $this
     * @see https://datatables.net/reference/option/select.items
     */
    public function selectItemsRow(): static
    {
        $this->attributes['select']['items'] = Builder::SELECT_ITEMS_ROW;

        return $this;
    }

    /**
     * Set select items option value to column.
     *
     * @return $this
     * @see https://datatables.net/reference/option/select.items
     */
    public function selectItemsColumn(): static
    {
        $this->attributes['select']['items'] = Builder::SELECT_ITEMS_COLUMN;

        return $this;
    }

    /**
     * Set select items option value to cell.
     *
     * @return $this
     * @see https://datatables.net/reference/option/select.items
     */
    public function selectItemsCell(): static
    {
        $this->attributes['select']['items'] = Builder::SELECT_ITEMS_CELL;

        return $this;
    }

    /**
     * Set select selector option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/select.selector
     */
    public function selectSelector(string $value = 'td'): static
    {
        $this->attributes['select']['selector'] = $value;

        return $this;
    }

    /**
     * Set select style option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/select.style
     */
    public function selectStyle(string $value = 'os'): static
    {
        $this->attributes['select']['style'] = $value;

        return $this;
    }

    /**
     * Set select style option value to api.
     *
     * @return $this
     * @see https://datatables.net/reference/option/select.style
     */
    public function selectStyleApi(): static
    {
        $this->attributes['select']['style'] = Builder::SELECT_STYLE_API;

        return $this;
    }

    /**
     * Set select style option value to single.
     *
     * @return $this
     * @see https://datatables.net/reference/option/select.style
     */
    public function selectStyleSingle(): static
    {
        $this->attributes['select']['style'] = Builder::SELECT_STYLE_SINGLE;

        return $this;
    }

    /**
     * Set select style option value to multi.
     *
     * @return $this
     * @see https://datatables.net/reference/option/select.style
     */
    public function selectStyleMulti(): static
    {
        $this->attributes['select']['style'] = Builder::SELECT_STYLE_MULTI;

        return $this;
    }

    /**
     * Set select style option value to os.
     *
     * @return $this
     * @see https://datatables.net/reference/option/select.style
     */
    public function selectStyleOS(): static
    {
        $this->attributes['select']['style'] = Builder::SELECT_STYLE_OS;

        return $this;
    }

    /**
     * Set select style option value to multi+shift.
     *
     * @return $this
     * @see https://datatables.net/reference/option/select.style
     */
    public function selectStyleMultiShift(): static
    {
        $this->attributes['select']['style'] = Builder::SELECT_STYLE_MULTI_SHIFT;

        return $this;
    }
}
