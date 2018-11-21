<?php

namespace Yajra\DataTables\Html\Options\Languages;

trait Aria
{
    /**
     * Set language aria option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/language.aria
     */
    public function languageAria(array $value)
    {
        $this->attributes['language']['aria'] = $value;

        return $this;
    }

    /**
     * Set language aria paginate option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/language.aria.paginate
     */
    public function languageAriaPaginate(array $value)
    {
        $this->attributes['language']['aria']['paginate'] = $value;

        return $this;
    }

    /**
     * Set language aria paginate first option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.aria.paginate.first
     */
    public function languageAriaPaginateFirst($value)
    {
        $this->attributes['language']['aria']['paginate']['first'] = $value;

        return $this;
    }

    /**
     * Set language aria paginate last option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.aria.paginate.last
     */
    public function languageAriaPaginateLast($value)
    {
        $this->attributes['language']['aria']['paginate']['last'] = $value;

        return $this;
    }

    /**
     * Set language aria paginate next option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.aria.paginate.next
     */
    public function languageAriaPaginateNext($value)
    {
        $this->attributes['language']['aria']['paginate']['next'] = $value;

        return $this;
    }

    /**
     * Set language aria paginate previous option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.aria.paginate.previous
     */
    public function languageAriaPaginatePrevious($value)
    {
        $this->attributes['language']['aria']['paginate']['previous'] = $value;

        return $this;
    }

    /**
     * Set language aria sortAscending option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.aria.sortAscending
     */
    public function languageAriaSortAscending($value)
    {
        $this->attributes['language']['aria']['sortAscending'] = $value;

        return $this;
    }

    /**
     * Set language aria sortDescending option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.aria.sortDescending
     */
    public function languageAriaSortDescending($value)
    {
        $this->attributes['language']['aria']['sortDescending'] = $value;

        return $this;
    }
}
