<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;
use Illuminate\Support\Collection;

/**
 * @property string $content
 * @method content($content)
 */
class Row extends Fluent
{
    public function __construct(array $attributes = [], array $cells = [])
    {
        $attributes['attributes'] ??= [];

        $this->buildCells($cells);

        parent::__construct($attributes);
    }

    /**
     * Make a new column instance.
     */
    public static function make(array $attributes = [], array $cells = []): static
    {
        return new static($attributes, $cells);
    }

    public function cells($cells): static
    {
        $this->cells = collect($cells);

        return $this;
    }

    protected function buildCells(array $cells): static
    {
        $this->cells = new Collection;

        foreach ($cells as $key => $value) {
            if (! is_a($value, Cell::class)) {
                if (is_array($value)) {
                    $cellAttributes = array_merge($value, [
                        'column' => $value['column'] ?? $key,
                        'content' => $value['content'] ?? null,
                    ]);
                } else {
                    $cellAttributes = [
                        'column' => $key,
                        'content' => $value,
                    ];
                }

                $this->cells->push(new Cell($cellAttributes));
            } else {
                $this->cells->push($value);
            }
        }

        $this->cells = $this->cells->keyBy('column');

        return $this;
    }

    public function getCellContentForColumn(Column $column): mixed
    {
        if ($this->cells->has($column->data)) {
            return $this->cells->get($column->data)->content;
        }

        return null;
    }
}
