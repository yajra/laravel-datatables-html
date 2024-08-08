<?php

namespace Yajra\DataTables\Html\Options;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Row;

/**
 * DataTables - Row option builder.
 */
trait HasRows
{
    /**
     * Set columns option value.
     *
     * @return $this
     *
     * @see https://datatables.net/reference/option/columns
     */
    public function rows(array $rows): static
    {
        $this->rows = new Collection;

        foreach ($rows as $key => $value) {
            if (! is_a($value, Row::class)) {
                if (array_key_exists('cells', $value)) {
                    $cells = $value['cells'];
                    $attributes = $value['attributes'] ?? [];
                } else {
                    $cells = $value;
                    $attributes = [];
                }

                $this->rows->push(new Row($attributes, $cells));
            } else {
                $this->rows->push($value);
            }
        }

        return $this;
    }

    public function setRows(Collection|array $rows): static
    {
        $this->rows = collect($rows);

        return $this;
    }

    /**
     * Get collection of rows.
     *
     * @return \Illuminate\Support\Collection<array-key, array>
     */
    public function getRows(): Collection
    {
        return $this->rows;
    }
}
