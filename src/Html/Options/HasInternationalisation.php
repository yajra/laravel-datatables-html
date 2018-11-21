<?php

namespace Yajra\DataTables\Html\Options;

use Yajra\DataTables\Html\Options\Languages;

/**
 * DataTables - Internationalisation option builder.
 *
 * @see https://datatables.net/reference/option/
 */
trait HasInternationalisation
{
    use Languages\Aria;
    use Languages\AutoFill;
    use Languages\Paginate;

    /**
     * Set language option value.
     *
     * @param string|array $value
     * @return $this
     * @see https://datatables.net/reference/option/language
     */
    public function language($value)
    {
        if (is_array($value)) {
            $this->attributes['language'] = $value;
        } else {
            $this->attributes['language']['url'] = $value;
        }

        return $this;
    }
}
