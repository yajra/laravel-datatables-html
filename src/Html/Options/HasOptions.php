<?php

namespace Yajra\DataTables\Html\Options;

use Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - Options builder.
 *
 * @see https://datatables.net/reference/option/
 */
trait HasOptions
{
    use HasFeatures;
    use HasData;
    use HasCallbacks;
    use HasColumns;
    use HasInternationalisation;
    use Plugins\AutoFill;
    use Plugins\Buttons;
    use Plugins\ColReorder;
    use Plugins\FixedColumns;
    use Plugins\FixedHeader;
    use Plugins\KeyTable;
    use Plugins\Responsive;

    /**
     * Set deferLoading option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/deferLoading
     */
    public function deferLoading($value = null)
    {
        $this->attributes['deferLoading'] = $value;

        return $this;
    }

    /**
     * Set destroy option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/destroy
     */
    public function destroy(bool $value = false)
    {
        $this->attributes['destroy'] = $value;

        return $this;
    }

    /**
     * Set displayStart option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/displayStart
     */
    public function displayStart(int $value = 0)
    {
        $this->attributes['displayStart'] = $value;

        return $this;
    }

    /**
     * Set dom option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/dom
     */
    public function dom(string $value)
    {
        $this->attributes['dom'] = $value;

        return $this;
    }

    /**
     * Set lengthMenu option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/lengthMenu
     */
    public function lengthMenu(array $value = [10, 25, 50, 100])
    {
        $this->attributes['lengthMenu'] = $value;

        return $this;
    }

    /**
     * Set orders option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/order
     */
    public function orders(array $value)
    {
        $this->attributes['order'] = $value;

        return $this;
    }

    /**
     * Set orderCellsTop option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/orderCellsTop
     */
    public function orderCellsTop(bool $value = false)
    {
        $this->attributes['orderCellsTop'] = $value;

        return $this;
    }

    /**
     * Set orderClasses option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/orderClasses
     */
    public function orderClasses(bool $value = true)
    {
        $this->attributes['orderClasses'] = $value;

        return $this;
    }

    /**
     * Order option builder.
     *
     * @param int|array $index
     * @param string $direction
     * @return $this
     * @see https://datatables.net/reference/option/order
     */
    public function orderBy($index, $direction = 'desc')
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
     * @param int|array $index
     * @param string $direction
     * @return $this
     * @see https://datatables.net/reference/option/orderFixed
     */
    public function orderByFixed($index, $direction = 'desc')
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
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/orderMulti
     */
    public function orderMulti(bool $value = true)
    {
        $this->attributes['orderMulti'] = $value;

        return $this;
    }

    /**
     * Set pageLength option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/pageLength
     */
    public function pageLength(int $value = 10)
    {
        $this->attributes['pageLength'] = $value;

        return $this;
    }

    /**
     * Set pagingType option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/pagingType
     */
    public function pagingType(string $value = 'simple_numbers')
    {
        $this->attributes['pagingType'] = $value;

        return $this;
    }

    /**
     * Set renderer option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/renderer
     */
    public function renderer($value = 'bootstrap')
    {
        $this->attributes['renderer'] = $value;

        return $this;
    }

    /**
     * Set retrieve option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/retrieve
     */
    public function retrieve(bool $value = false)
    {
        $this->attributes['retrieve'] = $value;

        return $this;
    }

    /**
     * Set rowId option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/rowId
     */
    public function rowId(string $value = 'DT_RowId')
    {
        $this->attributes['rowId'] = $value;

        return $this;
    }

    /**
     * Set scrollCollapse option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/scrollCollapse
     */
    public function scrollCollapse($value = false)
    {
        $this->attributes['scrollCollapse'] = $value;

        return $this;
    }

    /**
     * Set search option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/search
     */
    public function search(array $value)
    {
        $this->attributes['search'] = $value;

        return $this;
    }

    /**
     * Set searchCols option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/searchCols
     */
    public function searchCols(array $value)
    {
        $this->attributes['searchCols'] = $value;

        return $this;
    }

    /**
     * Set searchDelay option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/searchDelay
     */
    public function searchDelay(int $value)
    {
        $this->attributes['searchDelay'] = $value;

        return $this;
    }

    /**
     * Set stateDuration option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/stateDuration
     */
    public function stateDuration(int $value)
    {
        $this->attributes['stateDuration'] = $value;

        return $this;
    }

    /**
     * Set stripeClasses option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/stripeClasses
     */
    public function stripeClasses(array $value)
    {
        $this->attributes['stripeClasses'] = $value;

        return $this;
    }

    /**
     * Set tabIndex option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/tabIndex
     */
    public function tabIndex(int $value = 0)
    {
        $this->attributes['tabIndex'] = $value;

        return $this;
    }
}
