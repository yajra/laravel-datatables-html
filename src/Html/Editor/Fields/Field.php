<?php

namespace Yajra\DataTables\Html\Editor\Fields;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\HasAuthorizations;

/**
 * @see https://editor.datatables.net/reference/option/
 */
class Field extends Fluent
{
    use HasAuthorizations;

    /**
     * Field type.
     *
     * @var string
     */
    protected string $type = 'text';

    /**
     * Password constructor.
     *
     * @param  array  $attributes
     */
    public function __construct($attributes = [])
    {
        $attributes['type'] = $attributes['type'] ?? $this->type;

        parent::__construct($attributes);
    }

    /**
     * Make a new instance of a field.
     *
     * @param  array|string  $name
     * @param  string  $label
     * @return static
     */
    public static function make(array|string $name, string $label = ''): static
    {
        if (is_array($name)) {
            return new static($name);
        }

        $data = [
            'name' => $name,
            'label' => $label ?: Str::title(str_replace('_', ' ', $name)),
        ];

        return new static($data);
    }

    /**
     * @param  string  $label
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.label
     */
    public function label(string $label): static
    {
        $this->attributes['label'] = $label;

        return $this;
    }

    /**
     * @param  string  $name
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.name
     */
    public function name(string $name): static
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    /**
     * @param  string  $data
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.data
     */
    public function data(string $data): static
    {
        $this->attributes['data'] = $data;

        return $this;
    }

    /**
     * @param  string  $type
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.type
     */
    public function type(string $type): static
    {
        $this->attributes['type'] = $type;
        $this->type = $type;

        return $this;
    }

    /**
     * Get options from a model.
     *
     * @param  class-string|\Illuminate\Database\Eloquent\Builder  $model
     * @param  string  $value
     * @param  string  $key
     * @return $this
     */
    public function modelOptions($model, string $value, string $key = 'id'): static
    {
        return $this->options(
            Options::model($model, $value, $key)
        );
    }

    /**
     * Set select options.
     *
     * @param  array|Arrayable  $options
     * @return $this
     */
    public function options(array|Arrayable $options): static
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
     * @param  QueryBuilder|\Closure|string  $table
     * @param  string  $value
     * @param  string  $key
     * @param  \Closure|null  $whereCallback
     * @param  string|null  $connection
     * @return $this
     */
    public function tableOptions(
        QueryBuilder|Closure|string $table,
        string $value,
        string $key = 'id',
        Closure $whereCallback = null,
        string $connection = null
    ): static {
        return $this->options(
            Options::table($table, $value, $key, $whereCallback, $connection)
        );
    }

    /**
     * Set checkbox separator.
     *
     * @param  string  $separator
     * @return $this
     */
    public function separator(string $separator = ','): static
    {
        $this->attributes['separator'] = $separator;

        return $this;
    }

    /**
     * Set dateTime format.
     *
     * @param  string  $format
     * @return $this
     * @see https://editor.datatables.net/reference/field/datetime
     */
    public function format(string $format): static
    {
        $this->attributes['format'] = $format;

        return $this;
    }

    /**
     * Set field default value.
     *
     * @param  float|bool|int|string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.def
     */
    public function default(float|bool|int|string $value): static
    {
        $this->attributes['def'] = $value;

        return $this;
    }

    /**
     * Set field message value.
     *
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.message
     */
    public function message(string $value): static
    {
        $this->attributes['message'] = $value;

        return $this;
    }

    /**
     * Set field fieldInfo value.
     *
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.fieldInfo
     */
    public function fieldInfo(string $value): static
    {
        $this->attributes['fieldInfo'] = $value;

        return $this;
    }

    /**
     * Set field labelInfo value.
     *
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.labelInfo
     */
    public function labelInfo(string $value): static
    {
        $this->attributes['labelInfo'] = $value;

        return $this;
    }

    /**
     * Set field entityDecode value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.entityDecode
     */
    public function entityDecode(bool $value): static
    {
        $this->attributes['entityDecode'] = $value;

        return $this;
    }

    /**
     * Set field multiEditable value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.multiEditable
     */
    public function multiEditable(bool $value): static
    {
        $this->attributes['multiEditable'] = $value;

        return $this;
    }

    /**
     * Set field id value.
     *
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.id
     */
    public function id(string $value): static
    {
        $this->attributes['id'] = $value;

        return $this;
    }

    /**
     * Set field submit value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.submit
     */
    public function submit(bool $value): static
    {
        $this->attributes['submit'] = $value;

        return $this;
    }

    /**
     * Set field compare value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields.compare
     */
    public function compare(bool $value): static
    {
        $this->attributes['compare'] = $value;

        return $this;
    }

    /**
     * Set field opts value.
     *
     * @param  array  $value
     * @return $this
     * @see https://datatables.net/forums/discussion/comment/156581/#Comment_156581
     */
    public function opts(array $value): static
    {
        if (! isset($this->attributes['opts'])) {
            $this->attributes['opts'] = $value;
        } else {
            $this->attributes['opts'] = array_merge((array) $this->attributes['opts'], $value);
        }

        return $this;
    }

    /**
     * Set field element html attributes.
     *
     * @param  string  $attribute
     * @param  int|bool|string  $value
     * @return $this
     * @see https://datatables.net/forums/discussion/comment/156581/#Comment_156581
     */
    public function attr(string $attribute, int|bool|string $value): static
    {
        if (! isset($this->attributes['attr'])) {
            $this->attributes['attr'] = [];
        }

        $attributes = (array) $this->attributes['attr'];
        $attributes[$attribute] = $value;

        $this->attributes['attr'] = $attributes;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
