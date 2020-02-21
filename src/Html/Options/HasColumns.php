<?php

namespace Yajra\DataTables\Html\Options;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;

/**
 * DataTables - Columns option builder.
 *
 * @see https://datatables.net/reference/option/
 */
trait HasColumns
{
    /**
     * Set columnDefs option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/columnDefs
     */
    public function columnDefs(array $value)
    {
        $this->attributes['columnDefs'] = $value;

        return $this;
    }

    private function camelRelation($column)
    {

        $parts      = explode('.', $column);
        $columnName = array_pop($parts);
        $relation   = Str::camel(implode('.', $parts));

        return $relation . ($relation ? '.' : '') . $columnName;
    }
    /**
     * Set columns option value.
     *
     * @param array $columns
     * @return $this
     * @see https://datatables.net/reference/option/columns
     */
    public function columns(array $columns)
    {
        $this->collection = new Collection;

        foreach ($columns as $key => $value) {
            if (! is_a($value, Column::class)) {
                if (is_array($value)) {
                    $attributes = array_merge(
                        [
                            'name' => $value['name'] ?? $this->camelRelation($value['data'] ?? $key),
                            'data' => $value['data'] ?? $key,
                        ],
                        $this->setTitle($key, $value)
                    );
                } else {
                    $attributes = [
                        'name' => $this->camelRelation($value),
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
     * @param string $title
     * @param array $attributes
     * @return array
     */
    public function setTitle($title, array $attributes)
    {
        if (! isset($attributes['title'])) {
            $attributes['title'] = $this->getQualifiedTitle($title);
        }

        return $attributes;
    }

    /**
     * Convert string into a readable title.
     *
     * @param string $title
     * @return string
     */
    public function getQualifiedTitle($title)
    {
        return Str::title(str_replace(['.', '_'], ' ', Str::snake($title)));
    }

    /**
     * Add a column in collection usingsl attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function addColumn(array $attributes)
    {
        $this->collection->push(new Column($attributes));

        return $this;
    }

    /**
     * Add a Column object at the beginning of collection.
     *
     * @param \Yajra\DataTables\Html\Column $column
     * @return $this
     */
    public function addBefore(Column $column)
    {
        $this->collection->prepend($column);

        return $this;
    }

    /**
     * Add a column at the beginning of collection using attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function addColumnBefore(array $attributes)
    {
        $this->collection->prepend(new Column($attributes));

        return $this;
    }

    /**
     * Add a Column object in collection.
     *
     * @param \Yajra\DataTables\Html\Column $column
     * @return $this
     */
    public function add(Column $column)
    {
        $this->collection->push($column);

        return $this;
    }

    /**
     * Get collection of columns.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getColumns()
    {
        return $this->collection;
    }

    /**
     * Remove column by name.
     *
     * @param array $names
     * @return $this
     */
    public function removeColumn(...$names)
    {
        foreach ($names as $name) {
            $this->collection = $this->collection->filter(function (Column $column) use ($name) {
                return $column->name !== $name;
            })->flatten();
        }

        return $this;
    }
}
