<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;
use Illuminate\Contracts\Support\Arrayable;
use Yajra\DataTables\Html\Editor\Fields\Options;

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
     * @see https://datatables.net/reference/option/columns.searchPanes.dtOpts
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
     * @param array $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.panes
     */
    public function panes(array $value)
    {
        $panes = collect($value)->map(function ($pane) {
            if ($pane instanceof Arrayable) {
                return $pane->toArray();
            }

            return $pane;
        })->toArray();

        $this->attributes['panes'] = $panes;

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

    /**
     * Get options from a model.
     *
     * @param mixed $model
     * @param string $value
     * @param string $key
     * @return $this
     */
    public function modelOptions($model, $value, $key = 'id')
    {
        return $this->options(
            Options::model($model, $value, $key)
        );
    }

    /**
     * @param mixed $value
     * @return static
     * @see https://datatables.net/reference/option/columns.searchPanes.options
     */
    public function options($value)
    {
        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        }

        $this->attributes['options'] = $value;

        return $this;
    }

    /**
     * Get options from a table.
     *
     * @param mixed $table
     * @param string $value
     * @param string $key
     * @param \Closure $whereCallback
     * @param string|null $key
     * @return $this
     */
    public function tableOptions($table, $value, $key = 'id', \Closure $whereCallback = null, $connection = null)
    {
        return $this->options(
            Options::table($table, $value, $key, $whereCallback, $connection)
        );
    }

    /**
     * @param mixed $value
     * @return static
     * @see https://datatables.net/reference/option/columns.searchPanes.className
     */
    public function className($value)
    {
        $this->attributes['className'] = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return static
     * @see https://datatables.net/reference/option/searchPanes.panes.header
     */
    public function header($value)
    {
        $this->attributes['header'] = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return static
     * @see https://datatables.net/reference/option/columns.searchPanes.show
     */
    public function show($value = true)
    {
        $this->attributes['show'] = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return static
     * @see https://datatables.net/reference/option/columns.searchPanes.name
     */
    public function name($value)
    {
        $this->attributes['name'] = $value;

        return $this;
    }
}
