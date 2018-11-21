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

    /**
     * Set language decimal option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.decimal
     */
    public function languageDecimal($value)
    {
        $this->attributes['language']['decimal'] = $value;

        return $this;
    }

    /**
     * Set language emptyTable option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.emptyTable
     */
    public function languageEmptyTable($value)
    {
        $this->attributes['language']['emptyTable'] = $value;

        return $this;
    }

    /**
     * Set language info option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.info
     */
    public function languageInfo($value)
    {
        $this->attributes['language']['info'] = $value;

        return $this;
    }

    /**
     * Set language infoEmpty option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.infoEmpty
     */
    public function languageInfoEmpty($value)
    {
        $this->attributes['language']['infoEmpty'] = $value;

        return $this;
    }

    /**
     * Set language infoFiltered option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.infoFiltered
     */
    public function languageInfoFiltered($value)
    {
        $this->attributes['language']['infoFiltered'] = $value;

        return $this;
    }

    /**
     * Set language infoPostFix option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.infoPostFix
     */
    public function languageInfoPostFix($value)
    {
        $this->attributes['language']['infoPostFix'] = $value;

        return $this;
    }

    /**
     * Set language lengthMenu option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.lengthMenu
     */
    public function languageLengthMenu($value)
    {
        $this->attributes['language']['lengthMenu'] = $value;

        return $this;
    }

    /**
     * Set language loadingRecords option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.loadingRecords
     */
    public function languageLoadingRecords($value)
    {
        $this->attributes['language']['loadingRecords'] = $value;

        return $this;
    }

    /**
     * Set language processing option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.processing
     */
    public function languageProcessing($value)
    {
        $this->attributes['language']['processing'] = $value;

        return $this;
    }

    /**
     * Set language search option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.search
     */
    public function languageSearch($value)
    {
        $this->attributes['language']['search'] = $value;

        return $this;
    }

    /**
     * Set language searchPlaceholder option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.searchPlaceholder
     */
    public function languageSearchPlaceholder($value)
    {
        $this->attributes['language']['searchPlaceholder'] = $value;

        return $this;
    }

    /**
     * Set language thousands option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.thousands
     */
    public function languageThousands($value)
    {
        $this->attributes['language']['thousands'] = $value;

        return $this;
    }

    /**
     * Set language url option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.url
     */
    public function languageUrl($value)
    {
        $this->attributes['language']['url'] = $value;

        return $this;
    }

    /**
     * Set language zeroRecords option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/language.zeroRecords
     */
    public function languageZeroRecords($value)
    {
        $this->attributes['language']['zeroRecords'] = $value;

        return $this;
    }
}
