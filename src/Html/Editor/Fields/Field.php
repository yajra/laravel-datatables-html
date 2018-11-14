<?php

namespace Yajra\DataTables\Html\Editor\Fields;

use Illuminate\Support\Str;
use Illuminate\Support\Fluent;
use Illuminate\Contracts\Support\Arrayable;

/**
 * @see https://editor.datatables.net/reference/option/
 */
class Field extends Fluent
{
    /**
     * Field type.
     *
     * @var string
     */
    protected $type = 'text';

    /**
     * Password constructor.
     */
    public function __construct($attributes = [])
    {
        $attributes['type'] = $attributes['type'] ?? $this->type;

        parent::__construct($attributes);
    }

    /**
     * Make a new instance of a field.
     *
     * @param string $name
     * @param string $label
     * @return Field
     */
    public static function make($name, $label = '')
    {
        if (is_array($name)) {
            return new static($name);
        }

        $data = [
            'name'  => $name,
            'label' => $label ?: Str::title(str_replace('_', ' ', $name)),
        ];

        return new static($data);
    }

    /**
     * @param string $label
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.label
     */
    public function label($label)
    {
        $this->attributes['label'] = $label;

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.name
     */
    public function name($name)
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    /**
     * @param string $data
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.data
     */
    public function data($data)
    {
        $this->attributes['data'] = $data;

        return $this;
    }

    /**
     * @param string $type
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.type
     */
    public function type($type)
    {
        $this->attributes['type'] = $type;

        return $this;
    }

    /**
     * Get options from a model.
     *
     * @param mixed $model
     * @param string $value
     * @param string $key
     * @return Field
     */
    public function modelOptions($model, $value, $key = 'id')
    {
        return $this->options(
            Options::model($model, $value, $key)
        );
    }

    /**
     * Set select options.
     *
     * @param array|mixed $options
     * @return $this
     */
    public function options($options)
    {
        if ($options instanceof Arrayable) {
            $options = $options->toArray();
        }

        $this->attributes['options'] = $options;

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
     * @return Field
     */
    public function tableOptions($table, $value, $key = 'id', \Closure $whereCallback = null, $connection = null)
    {
        return $this->options(
            Options::table($table, $value, $key, $whereCallback, $connection)
        );
    }

    /**
     * Set checkbox separator.
     *
     * @param string $separator
     * @return $this
     */
    public function separator($separator = ',')
    {
        $this->attributes['separator'] = $separator;

        return $this;
    }

    /**
     * Set dateTime format.
     *
     * @param string $format
     * @return $this
     * @see https://editor.datatables.net/reference/field/datetime
     */
    public function format($format)
    {
        $this->attributes['format'] = $format;

        return $this;
    }

    /**
     * Set field default value.
     *
     * @param mixed $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.def
     */
    public function default($value)
    {
        $this->attributes['def'] = $value;

        return $this;
    }

    /**
     * Set field message value.
     *
     * @param string $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.message
     */
    public function message($value)
    {
        $this->attributes['message'] = $value;

        return $this;
    }

    /**
     * Set field fieldInfo value.
     *
     * @param string $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.fieldInfo
     */
    public function fieldInfo($value)
    {
        $this->attributes['fieldInfo'] = $value;

        return $this;
    }

    /**
     * Set field labelInfo value.
     *
     * @param string $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.labelInfo
     */
    public function labelInfo($value)
    {
        $this->attributes['labelInfo'] = $value;

        return $this;
    }

    /**
     * Set field entityDecode value.
     *
     * @param mixed|bool $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.entityDecode
     */
    public function entityDecode($value)
    {
        $this->attributes['entityDecode'] = $value;

        return $this;
    }

    /**
     * Set field multiEditable value.
     *
     * @param mixed|bool $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.multiEditable
     */
    public function multiEditable($value)
    {
        $this->attributes['multiEditable'] = $value;

        return $this;
    }

    /**
     * Set field id value.
     *
     * @param string $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.id
     */
    public function id($value)
    {
        $this->attributes['id'] = $value;

        return $this;
    }

    /**
     * Set field submit value.
     *
     * @param bool $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.submit
     */
    public function submit($value)
    {
        $this->attributes['submit'] = $value;

        return $this;
    }

    /**
     * Set field compare value.
     *
     * @param bool $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.compare
     */
    public function compare($value)
    {
        $this->attributes['compare'] = $value;

        return $this;
    }
}
