<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - AutoFill plugin option builder.
 *
 * @see https://datatables.net/extensions/autofill/
 * @see https://datatables.net/reference/option/autoFill
 * @see https://datatables.net/reference/option/#autoFill
 */
trait AutoFill
{
    /**
     * Set autoFill alwaysAsk option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.alwaysAsk
     */
    public function autoFillAlwaysAsk(bool $value = true): static
    {
        return $this->autoFill(['alwaysAsk' => $value]);
    }

    /**
     * Set autoFill option value.
     * Enable and configure the AutoFill extension for DataTables.
     *
     * @param  bool|array  $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill
     */
    public function autoFill(bool|array $value = true): static
    {
        if (is_array($value)) {
            $this->attributes['autoFill'] = array_merge((array) $this->attributes['autoFill'], $value);
        } else {
            $this->attributes['autoFill'] = $value;
        }

        return $this;
    }

    /**
     * Set autoFill columns option value.
     *
     * @param  array|string  $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.columns
     */
    public function autoFillColumns(array|string $value): static
    {
        return $this->autoFill(['columns' => $value]);
    }

    /**
     * Set autoFill editor option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.editor
     */
    public function autoFillEditor(string $value): static
    {
        return $this->autoFill(['editor' => $value]);
    }

    /**
     * Set autoFill enable option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.enable
     */
    public function autoFillEnable(bool $value = true): static
    {
        return $this->autoFill(['enable' => $value]);
    }

    /**
     * Set autoFill focus option value.
     *
     * @param  string|null  $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.focus
     */
    public function autoFillFocus(string $value = null): static
    {
        return $this->autoFill(['focus' => $value]);
    }

    /**
     * Set autoFill horizontal option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.horizontal
     */
    public function autoFillHorizontal(bool $value = true): static
    {
        return $this->autoFill(['horizontal' => $value]);
    }

    /**
     * Set autoFill update option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.update
     */
    public function autoFillUpdate(bool $value = true): static
    {
        return $this->autoFill(['update' => $value]);
    }

    /**
     * Set autoFill vertical option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/autoFill.vertical
     */
    public function autoFillVertical(bool $value = true): static
    {
        return $this->autoFill(['vertical' => $value]);
    }

    /**
     * @param  string|null  $key
     * @return mixed
     */
    public function getAutoFill(string $key = null): mixed
    {
        if (is_null($key)) {
            return $this->attributes['autoFill'] ?? true;
        }

        return $this->attributes['autoFill'][$key] ?? false;
    }
}
