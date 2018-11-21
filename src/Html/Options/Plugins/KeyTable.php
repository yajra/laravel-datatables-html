<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - KeyTable plugin option builder.
 *
 * @see https://datatables.net/extensions/keytable/
 * @see https://datatables.net/reference/option/keys
 * @see https://datatables.net/reference/option/#keys
 */
trait KeyTable
{
    /**
     * Set keys option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/keys
     */
    public function keys($value = true)
    {
        $this->attributes['keys'] = $value;

        return $this;
    }

    /**
     * Set keys blurable option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.blurable
     */
    public function keysBlurable(bool $value = true)
    {
        $this->attributes['keys']['blurable'] = $value;

        return $this;
    }

    /**
     * Set keys className option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.className
     */
    public function keysClassName($value = 'focus')
    {
        $this->attributes['keys']['className'] = $value;

        return $this;
    }

    /**
     * Set keys clipboard option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.clipboard
     */
    public function keysClipboard(bool $value = true)
    {
        $this->attributes['keys']['clipboard'] = $value;

        return $this;
    }

    /**
     * Set keys clipboardOrthogonal option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.clipboardOrthogonal
     */
    public function keysClipboardOrthogonal($value = 'display')
    {
        $this->attributes['keys']['clipboardOrthogonal'] = $value;

        return $this;
    }

    /**
     * Set keys columns option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.columns
     */
    public function keysColumns($value)
    {
        $this->attributes['keys']['columns'] = $value;

        return $this;
    }

    /**
     * Set keys editAutoSelect option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.editAutoSelect
     */
    public function keysEditAutoSelect(bool $value = true)
    {
        $this->attributes['keys']['editAutoSelect'] = $value;

        return $this;
    }

    /**
     * Set keys editOnFocus option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.editOnFocus
     */
    public function keysEditOnFocus(bool $value = true)
    {
        $this->attributes['keys']['editOnFocus'] = $value;

        return $this;
    }

    /**
     * Set keys editor option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.editor
     */
    public function keysEditor($value)
    {
        $this->attributes['keys']['editor'] = $value;

        return $this;
    }

    /**
     * Set keys editorKeys option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.editorKeys
     */
    public function keysEditorKeys($value = 'navigation-only')
    {
        $this->attributes['keys']['editorKeys'] = $value;

        return $this;
    }

    /**
     * Set keys focus option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.focus
     */
    public function keysFocus($value)
    {
        $this->attributes['keys']['focus'] = $value;

        return $this;
    }

    /**
     * Set keys keys option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.keys
     */
    public function keysKeys($value)
    {
        $this->attributes['keys']['keys'] = $value;

        return $this;
    }

    /**
     * Set keys tabIndex option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/keys.tabIndex
     */
    public function keysTabIndex($value)
    {
        $this->attributes['keys']['tabIndex'] = $value;

        return $this;
    }
}
