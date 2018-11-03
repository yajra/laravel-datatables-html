<?php

namespace Yajra\DataTables\Html\Editor;

use Illuminate\Support\Str;
use Illuminate\Support\Fluent;
use Illuminate\Contracts\Support\Arrayable;

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
     * @param string $name
     * @param string $label
     * @return Field|Select|Password|DateTime|Checkbox|Radio|Hidden|ReadOnly|TextArea
     */
    public static function make($name, $label = '')
    {
        if (is_array($name)) {
            return new static($name);
        }

        $data = [
            'name'  => $name,
            'label' => $label ?: Str::title($name),
        ];

        return new static($data);
    }

    /**
     * @param string $label
     * @return $this
     */
    public function label($label)
    {
        $this->attributes['label'] = $label;

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    /**
     * @param string $data
     * @return $this
     */
    public function data($data)
    {
        $this->attributes['data'] = $data;

        return $this;
    }

    /**
     * @param string $type
     * @return $this
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
     */
    public function format($format)
    {
        $this->attributes['format'] = $format;

        return $this;
    }
}
