<?php

namespace Yajra\DataTables\Html\Options\Languages;

trait Select
{
    /**
     * Set language select option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/language.select
     */
    public function languageSelect($value)
    {
        $this->attributes['language']['select'] = $value;

        return $this;
    }

    /**
     * Set language select cells option value.
     *
     * @param string|array $value
     * @return $this
     * @see https://datatables.net/reference/option/language.select.cells
     */
    public function languageSelectCells($value)
    {
        $this->attributes['language']['select']['cells'] = $value;

        return $this;
    }

    /**
     * Set language select columns option value.
     *
     * @param string|array $value
     * @return $this
     * @see https://datatables.net/reference/option/language.select.columns
     */
    public function languageSelectColumns($value)
    {
        $this->attributes['language']['select']['columns'] = $value;

        return $this;
    }

    /**
     * Set language select rows option value.
     *
     * @param string|array $value
     * @return $this
     * @see https://datatables.net/reference/option/language.select.rows
     */
    public function languageSelectRows($value)
    {
        $this->attributes['language']['select']['rows'] = $value;

        return $this;
    }
}
