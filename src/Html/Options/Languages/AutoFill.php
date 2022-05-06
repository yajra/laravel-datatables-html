<?php

namespace Yajra\DataTables\Html\Options\Languages;

trait AutoFill
{
    /**
     * Set language autoFill option value.
     *
     * @param  array  $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill
     */
    public function languageAutoFill(array $value)
    {
        return $this->language(['autoFill' => $value]);
    }

    /**
     * Set language autoFill button option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.button
     */
    public function languageAutoFillButton(string $value)
    {
        return $this->languageAutoFill(['button' => $value]);
    }

    /**
     * Set language autoFill cancel option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.cancel
     */
    public function languageAutoFillCancel(string $value)
    {
        return $this->languageAutoFill(['cancel' => $value]);
    }

    /**
     * Set language autoFill fill option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.fill
     */
    public function languageAutoFillFill(string $value)
    {
        return $this->languageAutoFill(['fill' => $value]);
    }

    /**
     * Set language autoFill fillHorizontal option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.fillHorizontal
     */
    public function languageAutoFillFillHorizontal(string $value)
    {
        return $this->languageAutoFill(['fillHorizontal' => $value]);
    }

    /**
     * Set language autoFill fillVertical option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.fillVertical
     */
    public function languageAutoFillFillVertical(string $value)
    {
        return $this->languageAutoFill(['fillVertical' => $value]);
    }

    /**
     * Set language autoFill increment option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.increment
     */
    public function languageAutoFillIncrement(string $value)
    {
        return $this->languageAutoFill(['increment' => $value]);
    }

    /**
     * Set language autoFill info option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/language.autoFill.info
     */
    public function languageAutoFillInfo(string $value)
    {
        return $this->languageAutoFill(['info' => $value]);
    }
}
