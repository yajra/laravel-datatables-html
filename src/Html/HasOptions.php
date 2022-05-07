<?php

namespace Yajra\DataTables\Html;

use Yajra\DataTables\Html\Options;

/**
 * DataTables - Options builder.
 *
 * @see https://datatables.net/reference/option/
 */
trait HasOptions
{
    use Options\HasFeatures;
    use Options\HasData;
    use Options\HasCallbacks;
    use Options\HasColumns;
    use Options\HasInternationalisation;
    use Options\Plugins\AutoFill;
    use Options\Plugins\Buttons;
    use Options\Plugins\ColReorder;
    use Options\Plugins\FixedColumns;
    use Options\Plugins\FixedHeader;
    use Options\Plugins\KeyTable;
    use Options\Plugins\Responsive;
    use Options\Plugins\RowGroup;
    use Options\Plugins\RowReorder;
    use Options\Plugins\Scroller;
    use Options\Plugins\Select;
    use Options\Plugins\SearchPanes;

    /**
     * Set deferLoading option value.
     *
     * @param  array|int|null  $value
     * @return $this
     * @see https://datatables.net/reference/option/deferLoading
     */
    public function deferLoading(array|int $value = null): static
    {
        $this->attributes['deferLoading'] = $value;

        return $this;
    }

    /**
     * Set destroy option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/destroy
     */
    public function destroy(bool $value = false): static
    {
        $this->attributes['destroy'] = $value;

        return $this;
    }

    /**
     * Set displayStart option value.
     *
     * @param  int  $value
     * @return $this
     * @see https://datatables.net/reference/option/displayStart
     */
    public function displayStart(int $value = 0): static
    {
        $this->attributes['displayStart'] = $value;

        return $this;
    }

    /**
     * Set dom option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/dom
     */
    public function dom(string $value): static
    {
        $this->attributes['dom'] = $value;

        return $this;
    }

    /**
     * Set lengthMenu option value.
     *
     * @param  array  $value
     * @return $this
     * @see https://datatables.net/reference/option/lengthMenu
     */
    public function lengthMenu(array $value = [10, 25, 50, 100]): static
    {
        $this->attributes['lengthMenu'] = $value;

        return $this;
    }

    /**
     * Set orders option value.
     *
     * @param  array  $value
     * @return $this
     * @see https://datatables.net/reference/option/order
     */
    public function orders(array $value): static
    {
        $this->attributes['order'] = $value;

        return $this;
    }

    /**
     * Set orderCellsTop option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/orderCellsTop
     */
    public function orderCellsTop(bool $value = false): static
    {
        $this->attributes['orderCellsTop'] = $value;

        return $this;
    }

    /**
     * Set orderClasses option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/orderClasses
     */
    public function orderClasses(bool $value = true): static
    {
        $this->attributes['orderClasses'] = $value;

        return $this;
    }

    /**
     * Order option builder.
     *
     * @param  array|int  $index
     * @param  string  $direction
     * @return $this
     * @see https://datatables.net/reference/option/order
     */
    public function orderBy(array|int $index, string $direction = 'desc'): static
    {
        if ($direction != 'desc') {
            $direction = 'asc';
        }

        if (is_array($index)) {
            $this->attributes['order'][] = $index;
        } else {
            $this->attributes['order'][] = [$index, $direction];
        }

        return $this;
    }

    /**
     * Order Fixed option builder.
     *
     * @param  array|int  $index
     * @param  string  $direction
     * @return $this
     * @see https://datatables.net/reference/option/orderFixed
     */
    public function orderByFixed(array|int $index, string $direction = 'desc'): static
    {
        if ($direction != 'desc') {
            $direction = 'asc';
        }

        if (is_array($index)) {
            $this->attributes['orderFixed'][] = $index;
        } else {
            $this->attributes['orderFixed'][] = [$index, $direction];
        }

        return $this;
    }

    /**
     * Set orderMulti option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/orderMulti
     */
    public function orderMulti(bool $value = true): static
    {
        $this->attributes['orderMulti'] = $value;

        return $this;
    }

    /**
     * Set pageLength option value.
     *
     * @param  int  $value
     * @return $this
     * @see https://datatables.net/reference/option/pageLength
     */
    public function pageLength(int $value = 10): static
    {
        $this->attributes['pageLength'] = $value;

        return $this;
    }

    /**
     * Set pagingType option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/pagingType
     */
    public function pagingType(string $value = 'simple_numbers'): static
    {
        $this->attributes['pagingType'] = $value;

        return $this;
    }

    /**
     * Set renderer option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/renderer
     */
    public function renderer(string $value = 'bootstrap'): static
    {
        $this->attributes['renderer'] = $value;

        return $this;
    }

    /**
     * Set retrieve option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/retrieve
     */
    public function retrieve(bool $value = false): static
    {
        $this->attributes['retrieve'] = $value;

        return $this;
    }

    /**
     * Set rowId option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/rowId
     */
    public function rowId(string $value = 'DT_RowId'): static
    {
        $this->attributes['rowId'] = $value;

        return $this;
    }

    /**
     * Set scrollCollapse option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/scrollCollapse
     */
    public function scrollCollapse(bool $value = false): static
    {
        $this->attributes['scrollCollapse'] = $value;

        return $this;
    }

    /**
     * Set search option value.
     *
     * @param  array  $value
     * @return $this
     * @see https://datatables.net/reference/option/search
     */
    public function search(array $value): static
    {
        $this->attributes['search'] = $value;

        return $this;
    }

    /**
     * Set searchCols option value.
     *
     * @param  array  $value
     * @return $this
     * @see https://datatables.net/reference/option/searchCols
     */
    public function searchCols(array $value): static
    {
        $this->attributes['searchCols'] = $value;

        return $this;
    }

    /**
     * Set searchDelay option value.
     *
     * @param  int  $value
     * @return $this
     * @see https://datatables.net/reference/option/searchDelay
     */
    public function searchDelay(int $value): static
    {
        $this->attributes['searchDelay'] = $value;

        return $this;
    }

    /**
     * Set stateDuration option value.
     *
     * @param  int  $value
     * @return $this
     * @see https://datatables.net/reference/option/stateDuration
     */
    public function stateDuration(int $value): static
    {
        $this->attributes['stateDuration'] = $value;

        return $this;
    }

    /**
     * Set stripeClasses option value.
     *
     * @param  array  $value
     * @return $this
     * @see https://datatables.net/reference/option/stripeClasses
     */
    public function stripeClasses(array $value): static
    {
        $this->attributes['stripeClasses'] = $value;

        return $this;
    }

    /**
     * Set tabIndex option value.
     *
     * @param  int  $value
     * @return $this
     * @see https://datatables.net/reference/option/tabIndex
     */
    public function tabIndex(int $value = 0): static
    {
        $this->attributes['tabIndex'] = $value;

        return $this;
    }
}
