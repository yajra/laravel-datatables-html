<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;

/**
 * @property string $column
 * @property string $content
 */
class Cell extends Fluent
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $attributes['attributes'] ??= [];

        parent::__construct($attributes);
    }

    /**
     * Make a new column instance.
     */
    public static function make(array|string $data = [], string $content = ''): static
    {
        $attributes = $data;

        if (is_string($data)) {
            $attributes = [
                'column' => $data,
                'content' => $content,
            ];
        }

        return new static($attributes);
    }

    /**
     * @return $this
     */
    public function column(string $value): static
    {
        $this->attributes['column'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function content(string $value): static
    {
        $this->attributes['content'] = $value;

        return $this;
    }
}
