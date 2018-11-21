<?php

namespace Yajra\DataTables\Html\Options\Languages;

trait AutoFill
{
    /**
     * Set language autoFill option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill
     */
    public function languageAutoFill(array $value)
    {
        $this->attributes['language']['autoFill'] = $value;

        return $this;
    }

    /**
     * Set language autoFill button option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.button
     */
    public function languageAutoFillButton($value)
    {
        $this->attributes['language']['autoFill']['button'] = $value;

        return $this;
    }

    /**
     * Set language autoFill cancel option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.cancel
     */
    public function languageAutoFillCancel($value)
    {
        $this->attributes['language']['autoFill']['cancel'] = $value;

        return $this;
    }

    /**
     * Set language autoFill fill option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.fill
     */
    public function languageAutoFillFill($value)
    {
        $this->attributes['language']['autoFill']['fill'] = $value;

        return $this;
    }

    /**
     * Set language autoFill fillHorizontal option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.fillHorizontal
     */
    public function languageAutoFillFillHorizontal($value)
    {
        $this->attributes['language']['autoFill']['fillHorizontal'] = $value;

        return $this;
    }

    /**
     * Set language autoFill fillVertical option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.fillVertical
     */
    public function languageAutoFillFillVertical($value)
    {
        $this->attributes['language']['autoFill']['fillVertical'] = $value;

        return $this;
    }

    /**
     * Set language autoFill increment option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.increment
     */
    public function languageAutoFillIncrement($value)
    {
        $this->attributes['language']['autoFill']['increment'] = $value;

        return $this;
    }

    /**
     * Set language autoFill info option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.info
     */
    public function languageAutoFillInfo($value)
    {
        $this->attributes['language']['autoFill']['info'] = $value;

        return $this;
    }
}
