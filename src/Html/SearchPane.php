<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;

class SearchPane extends Fluent
{
    /**
     * @param array $options
     * @return static
     */
    public static function make(array $options = [])
    {
        return new static($options);
    }

    /**
     * @param bool $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.cascadePanes
     */
    public function cascadePanes($value = true)
    {
        $this->attributes['cascadePanes'] = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.clear
     */
    public function clear($value = true)
    {
        $this->attributes['clear'] = $value;

        return $this;
    }

    /**
     * @param array $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.columns
     */
    public function columns(array $value = [])
    {
        $this->attributes['columns'] = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.controls
     */
    public function controls($value = true)
    {
        $this->attributes['controls'] = $value;

        return $this;
    }

    /**
     * @param array $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.dtOpts
     */
    public function dtOpts(array $value = [])
    {
        $this->attributes['dtOpts'] = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.emptyMessage
     */
    public function emptyMessage($value)
    {
        $this->attributes['emptyMessage'] = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.filterChanged
     */
    public function filterChanged($value)
    {
        $this->attributes['filterChanged'] = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.hideCount
     */
    public function hideCount($value = true)
    {
        $this->attributes['hideCount'] = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.layout
     */
    public function layout($value)
    {
        $this->attributes['layout'] = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.order
     */
    public function order($value)
    {
        $this->attributes['order'] = $value;

        return $this;
    }

    /**
     * @param boolean $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.orderable
     */
    public function orderable($value = true)
    {
        $this->attributes['orderable'] = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.panes
     */
    public function panes($value)
    {
        $this->attributes['panes'] = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.threshold
     */
    public function threshold($value)
    {
        $this->attributes['threshold'] = $value;

        return $this;
    }

    /**
     * @param boolean $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.viewTotal
     */
    public function viewTotal($value = true)
    {
        $this->attributes['viewTotal'] = $value;

        return $this;
    }
}
