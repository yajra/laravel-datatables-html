<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - FixedColumns plugin option builder.
 *
 * @see https://datatables.net/extensions/fixedcolumns/
 * @see https://datatables.net/reference/option/fixedColumns
 * @see https://datatables.net/reference/option/#fixedColumns
 */
trait FixedColumns
{
    /**
     * Set fixedColumns heightMatch option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedColumns.heightMatch
     */
    public function fixedColumnsHeightMatch(string $value = 'semiauto'): static
    {
        return $this->fixedColumns(['heightMatch' => $value]);
    }

    /**
     * Set fixedColumns option value.
     *
     * @param  bool|array  $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedColumns
     */
    public function fixedColumns(bool|array $value = true): static
    {
        if (is_array($value)) {
            $this->attributes['fixedColumns'] = array_merge((array) $this->attributes['fixedColumns'], $value);
        } else {
            $this->attributes['fixedColumns'] = $value;
        }

        return $this;
    }

    /**
     * Set fixedColumns leftColumns option value.
     *
     * @param  int  $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedColumns.leftColumns
     */
    public function fixedColumnsLeftColumns(int $value = 1): static
    {
        return $this->fixedColumns(['leftColumns' => $value]);
    }

    /**
     * Set fixedColumns rightColumns option value.
     *
     * @param  int  $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedColumns.rightColumns
     */
    public function fixedColumnsRightColumns(int $value = 0): static
    {
        return $this->fixedColumns(['rightColumns' => $value]);
    }

    /**
     * @param  string|null  $key
     * @return mixed
     */
    public function getFixedColumns(string $key = null): mixed
    {
        if (is_null($key)) {
            return $this->attributes['fixedColumns'] ?? true;
        }

        return $this->attributes['fixedColumns'][$key] ?? false;
    }
}
