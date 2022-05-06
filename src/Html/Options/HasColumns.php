<?php

namespace Yajra\DataTables\Html\Options;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;

/**
 * DataTables - Columns option builder.
 *
 * @property Collection $collection
 * @see https://datatables.net/reference/option/
 */
trait HasColumns
{
    /**
     * Set columnDefs option value.
     *
     * @param  mixed  $value
     * @return $this
     * @see https://datatables.net/reference/option/columnDefs
     */
    public function columnDefs(mixed $value): static
    {
        if (is_callable($value)) {
            $value = app()->call($value);
        }

        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        }

        $this->attributes['columnDefs'] = $value;

        return $this;
    }

    /**
     * Add a columnDef option.
     *
     * @param  mixed  $value
     * @return $this
     * @see https://datatables.net/reference/option/columnDefs
     */
    public function addColumnDef(mixed $value): static
    {
        if (is_callable($value)) {
            $value = app()->call($value);
        }

        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        }

        $this->attributes['columnDefs'][] = $value;

        return $this;
    }

    /**
     * Set columns option value.
     *
     * @param  array  $columns
     * @return $this
     * @see https://datatables.net/reference/option/columns
     */
    public function columns(array $columns): static
    {
        $this->collection = new Collection;

        foreach ($columns as $key => $value) {
            if (! is_a($value, Column::class)) {
                if (is_array($value)) {
                    $attributes = array_merge(
                        [
                            'name' => $value['name'] ?? $value['data'] ?? $key,
                            'data' => $value['data'] ?? $key,
                        ],
                        $this->setTitle($key, $value)
                    );
                } else {
                    $attributes = [
                        'name' => $value,
                        'data' => $value,
                        'title' => $this->getQualifiedTitle($value),
                    ];
                }

                $this->collection->push(new Column($attributes));
            } else {
                $this->collection->push($value);
            }
        }

        return $this;
    }

    /**
     * Set title attribute of an array if not set.
     *
     * @param  string  $title
     * @param  array  $attributes
     * @return array
     */
    public function setTitle(string $title, array $attributes): array
    {
        if (! isset($attributes['title'])) {
            $attributes['title'] = $this->getQualifiedTitle($title);
        }

        return $attributes;
    }

    /**
     * Convert string into a readable title.
     *
     * @param  string  $title
     * @return string
     */
    public function getQualifiedTitle(string $title): string
    {
        return Str::title(str_replace(['.', '_'], ' ', Str::snake($title)));
    }

    /**
     * Add a column in collection usingsl attributes.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function addColumn(array $attributes): static
    {
        $this->collection->push(new Column($attributes));

        return $this;
    }

    /**
     * Add a Column object at the beginning of collection.
     *
     * @param  \Yajra\DataTables\Html\Column  $column
     * @return $this
     */
    public function addBefore(Column $column): static
    {
        $this->collection->prepend($column);

        return $this;
    }

    /**
     * Add a column at the beginning of collection using attributes.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function addColumnBefore(array $attributes): static
    {
        $this->collection->prepend(new Column($attributes));

        return $this;
    }

    /**
     * Add a Column object in collection.
     *
     * @param  \Yajra\DataTables\Html\Column  $column
     * @return $this
     */
    public function add(Column $column): static
    {
        $this->collection->push($column);

        return $this;
    }

    /**
     * Get collection of columns.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getColumns(): Collection
    {
        return $this->collection;
    }

    /**
     * Remove column by name.
     *
     * @param  array  $names
     * @return $this
     */
    public function removeColumn(...$names): static
    {
        foreach ($names as $name) {
            $this->collection = $this->collection->filter(function (Column $column) use ($name) {
                return $column->name !== $name;
            })->flatten();
        }

        return $this;
    }
}
