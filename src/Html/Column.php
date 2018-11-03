<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Str;
use Illuminate\Support\Fluent;

/**
 * @property string data
 * @property string name
 * @property string orderable
 * @property string searchable
 * @property string printable
 * @property string exportable
 * @property string footer
 * @property array attributes
 * @see     https://datatables.net/reference/option/ for possible columns option
 */
class Column extends Fluent
{
    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $attributes['title']      = isset($attributes['title']) ? $attributes['title'] : Str::title($attributes['data']);
        $attributes['orderable']  = isset($attributes['orderable']) ? $attributes['orderable'] : true;
        $attributes['searchable'] = isset($attributes['searchable']) ? $attributes['searchable'] : true;
        $attributes['exportable'] = isset($attributes['exportable']) ? $attributes['exportable'] : true;
        $attributes['printable']  = isset($attributes['printable']) ? $attributes['printable'] : true;
        $attributes['footer']     = isset($attributes['footer']) ? $attributes['footer'] : '';
        $attributes['attributes'] = isset($attributes['attributes']) ? $attributes['attributes'] : [];

        // Allow methods override attribute value
        foreach ($attributes as $attribute => $value) {
            $method = 'parse' . ucfirst(strtolower($attribute));
            if (method_exists($this, $method)) {
                $attributes[$attribute] = $this->$method($value);
            }
        }

        if (! isset($attributes['name']) && isset($attributes['data'])) {
            $attributes['name'] = $attributes['data'];
        }

        parent::__construct($attributes);
    }

    /**
     * Create a computed column that is not searchable/orderable.
     *
     * @param string $data
     * @param string $title
     * @return Column
     */
    public static function computed($data, $title = '')
    {
        return static::make($data)->title($title)->orderable(false)->searchable(false);
    }

    /**
     * Set column searchable flag.
     *
     * @param bool $flag
     * @return $this
     */
    public function searchable(bool $flag = true)
    {
        $this->attributes['searchable'] = $flag;

        return $this;
    }

    /**
     * Set column orderable flag.
     *
     * @param bool $flag
     * @return $this
     */
    public function orderable(bool $flag = true)
    {
        $this->attributes['orderable'] = $flag;

        return $this;
    }

    /**
     * Make a new column instance.
     *
     * @param string $data
     * @param string $name
     * @return Column
     */
    public static function make($data, $name = '')
    {
        $attr = [
            'data' => $data,
            'name' => $name ?: $data,
        ];

        return new static($attr);
    }

    /**
     * Create a checkbox column.
     *
     * @param string $title
     * @return Column
     */
    public static function checkbox($title = '')
    {
        return static::make('')
                     ->content('')
                    ->title($title)
                     ->className('select-checkbox')
                     ->orderable(false)
                     ->searchable(false);
    }

    /**
     * Set column class name.
     *
     * @param string $class
     * @return $this
     */
    public function className($class)
    {
        $this->attributes['className'] = $class;

        return $this;
    }

    /**
     * Append a class name to field.
     *
     * @param string $class
     * @return $this
     */
    public function addClass($class)
    {
        if (! isset($this->attributes['className'])) {
            $this->attributes['className'] = $class;
        } else {
            $this->attributes['className'] .= " $class";
        }

        return $this;
    }

    /**
     * Set column default content.
     *
     * @param string $value
     * @return $this
     */
    public function content($value)
    {
        $this->attributes['defaultContent'] = $value;

        return $this;
    }

    /**
     * Set column exportable flag.
     *
     * @param bool $flag
     * @return $this
     */
    public function exportable(bool $flag = true)
    {
        $this->attributes['exportable'] = $flag;

        return $this;
    }

    /**
     * Set column printable flag.
     *
     * @param bool $flag
     * @return $this
     */
    public function printable(bool $flag = true)
    {
        $this->attributes['printable'] = $flag;

        return $this;
    }

    /**
     * Set column width value.
     *
     * @param int|string $value
     * @return $this
     */
    public function width($value)
    {
        $this->attributes['width'] = $value;

        return $this;
    }

    /**
     * Set column title.
     *
     * @param string $value
     * @return $this
     */
    public function title($value)
    {
        $this->attributes['title'] = $value;

        return $this;
    }

    /**
     * Set column name.
     *
     * @param string $value
     * @return $this
     */
    public function name($value)
    {
        $this->attributes['name'] = $value;

        return $this;
    }

    /**
     * Set column renderer.
     *
     * @param mixed $value
     * @return $this
     */
    public function render($value)
    {
        $this->attributes['render'] = $value;

        return $this;
    }

    /**
     * Parse render attribute.
     *
     * @param mixed $value
     * @return string|null
     */
    public function parseRender($value)
    {
        /** @var \Illuminate\Contracts\View\Factory $view */
        $view       = app('view');
        $parameters = [];

        if (is_array($value)) {
            $parameters = array_except($value, 0);
            $value      = $value[0];
        }

        if (is_callable($value)) {
            return $value($parameters);
        } elseif ($this->isBuiltInRenderFunction($value)) {
            return $value;
        } elseif ($view->exists($value)) {
            return $view->make($value)->with($parameters)->render();
        }

        return $value ? $this->parseRenderAsString($value) : null;
    }

    /**
     * Check if given key & value is a valid datatables built-in renderer function.
     *
     * @param string $value
     * @return bool
     */
    private function isBuiltInRenderFunction($value)
    {
        if (empty($value)) {
            return false;
        }

        return Str::startsWith(trim($value), ['$.fn.dataTable.render']);
    }

    /**
     * Display render value as is.
     *
     * @param mixed $value
     * @return string
     */
    private function parseRenderAsString($value)
    {
        return "function(data,type,full,meta){return $value;}";
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array_except($this->attributes, ['printable', 'exportable', 'footer']);
    }
}
