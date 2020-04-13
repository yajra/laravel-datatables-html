<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Arr;
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
 * @see https://datatables.net/reference/option/#columns
 */
class Column extends Fluent
{
    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $attributes['title']      = isset($attributes['title']) ? $attributes['title'] : self::titleFormat($attributes['data']);
        $attributes['orderable']  = isset($attributes['orderable']) ? $attributes['orderable'] : true;
        $attributes['searchable'] = isset($attributes['searchable']) ? $attributes['searchable'] : true;
        $attributes['exportable'] = isset($attributes['exportable']) ? $attributes['exportable'] : true;
        $attributes['printable']  = isset($attributes['printable']) ? $attributes['printable'] : true;
        $attributes['footer']     = isset($attributes['footer']) ? $attributes['footer'] : '';
        $attributes['attributes'] = isset($attributes['attributes']) ? $attributes['attributes'] : [];

        // Allow methods override attribute value
        foreach ($attributes as $attribute => $value) {
            $method = 'parse' . ucfirst(strtolower($attribute));
            if (! is_null($value) && method_exists($this, $method)) {
                $attributes[$attribute] = $this->$method($value);
            }
        }

        if (! isset($attributes['name']) && isset($attributes['data'])) {
            $attributes['name'] = $attributes['data'];
        }

        parent::__construct($attributes);
    }

    /**
     * Format string to title case.
     *
     * @param string $value
     * @return string
     */
    public static function titleFormat($value)
    {
        return Str::title(str_replace('_', ' ', $value));
    }

    /**
     * Create a computed column that is not searchable/orderable.
     *
     * @param string $data
     * @param string|null $title
     * @return Column
     */
    public static function computed($data, $title = null)
    {
        if (is_null($title)) {
            $title = self::titleFormat($data);
        }

        return static::make($data)->title($title)->orderable(false)->searchable(false);
    }

    /**
     * Set column searchable flag.
     *
     * @param bool $flag
     * @return $this
     * @see https://datatables.net/reference/option/columns.searchable
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
     * @see https://datatables.net/reference/option/columns.orderable
     */
    public function orderable(bool $flag = true)
    {
        $this->attributes['orderable'] = $flag;

        return $this;
    }

    /**
     * Set column title.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.title
     */
    public function title($value)
    {
        $this->attributes['title'] = $value;

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
     * @see https://datatables.net/reference/option/columns.className
     */
    public function className($class)
    {
        $this->attributes['className'] = $class;

        return $this;
    }

    /**
     * Set column default content.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.defaultContent
     */
    public function content($value)
    {
        $this->attributes['defaultContent'] = $value;

        return $this;
    }

    /**
     * Set column visible flag.
     *
     * @param bool $flag
     * @return $this
     * @see https://datatables.net/reference/option/columns.visible
     */
    public function visible(bool $flag = true)
    {
        $this->attributes['visible'] = $flag;

        return $this;
    }

    /**
     * Set column hidden state.
     *
     * @return $this
     * @see https://datatables.net/reference/option/columns.visible
     */
    public function hidden()
    {
        return $this->visible(false);
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
     * @see https://datatables.net/reference/option/columns.width
     */
    public function width($value)
    {
        $this->attributes['width'] = $value;

        return $this;
    }

    /**
     * Set column data option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.data
     */
    public function data($value)
    {
        $this->attributes['data'] = $value;

        return $this;
    }

    /**
     * Set column name option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.name
     */
    public function name($value)
    {
        $this->attributes['name'] = $value;

        return $this;
    }

    /**
     * Set column edit field option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.editField
     */
    public function editField($value)
    {
        $this->attributes['editField'] = $value;

        return $this;
    }

    /**
     * Set column orderData option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.orderData
     */
    public function orderData($value)
    {
        $this->attributes['orderData'] = $value;

        return $this;
    }

    /**
     * Set column orderDataType option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.orderDataType
     */
    public function orderDataType($value)
    {
        $this->attributes['orderDataType'] = $value;

        return $this;
    }

    /**
     * Set column orderSequence option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.orderSequence
     */
    public function orderSequence($value)
    {
        $this->attributes['orderSequence'] = $value;

        return $this;
    }

    /**
     * Set column cellType option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.cellType
     */
    public function cellType($value)
    {
        $this->attributes['cellType'] = $value;

        return $this;
    }

    /**
     * Set column type option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.type
     */
    public function type($value)
    {
        $this->attributes['type'] = $value;

        return $this;
    }

    /**
     * Set column contentPadding option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.contentPadding
     */
    public function contentPadding($value)
    {
        $this->attributes['contentPadding'] = $value;

        return $this;
    }

    /**
     * Set column createdCell option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.createdCell
     */
    public function createdCell($value)
    {
        $this->attributes['createdCell'] = $value;

        return $this;
    }

    /**
     * Use the js renderer "$.fn.dataTable.render.".
     *
     * @param mixed $value
     * @param mixed ...$params
     * @return $this
     * @see https://datatables.net/reference/option/columns.render
     */
    public function renderJs($value, ...$params)
    {
        if ($params) {
            $value .= '(';
            foreach ($params as $param) {
                $value .= "'{$param}',";
            }
            $value = mb_substr($value, 0, -1);
            $value .= ')';
        }

        $renderer = '$.fn.dataTable.render.' . $value;

        return $this->render($renderer);
    }

    /**
     * Set column renderer.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/columns.render
     */
    public function render($value)
    {
        $this->attributes['render'] = $this->parseRender($value);

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
            $parameters = Arr::except($value, 0);
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
     * Set column footer.
     *
     * @param mixed $value
     * @return $this
     */
    public function footer($value)
    {
        $this->attributes['footer'] = $value;

        return $this;
    }

    /**
     * Set custom html title instead defult label.
     *
     * @param mixed $value
     * @return $this
     */
    public function htmlTitle($value)
    {
        $this->attributes['html-title'] = $value;

        return $this;
    }
    
    /**
     * @return array
     */
    public function toArray()
    {
        return Arr::except($this->attributes, [
            'printable',
            'exportable',
            'footer',
        ]);
    }
}
