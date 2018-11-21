<?php

namespace Yajra\DataTables\Html\Options\Languages;

trait Paginate
{
    /**
     * Set language aria paginate option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.paginate
     */
    public function languagePaginate($value)
    {
        $this->attributes['language']['paginate'] = $value;

        return $this;
    }

    /**
     * Set language aria paginate first option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.paginate.first
     */
    public function languagePaginateFirst($value)
    {
        $this->attributes['language']['paginate']['first'] = $value;

        return $this;
    }

    /**
     * Set language aria paginate last option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.paginate.last
     */
    public function languagePaginateLast($value)
    {
        $this->attributes['language']['paginate']['last'] = $value;

        return $this;
    }

    /**
     * Set language aria paginate next option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.paginate.next
     */
    public function languagePaginateNext($value)
    {
        $this->attributes['language']['paginate']['next'] = $value;

        return $this;
    }

    /**
     * Set language aria paginate previous option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.paginate.previous
     */
    public function languagePaginatePrevious($value)
    {
        $this->attributes['language']['paginate']['previous'] = $value;

        return $this;
    }
}
