<?php

namespace Yajra\DataTables\Html\Editor;

use Illuminate\Support\Fluent;
use Illuminate\Support\Str;

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
            'name' => $name,
            'label' => $label ?: Str::title($name)
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
}
