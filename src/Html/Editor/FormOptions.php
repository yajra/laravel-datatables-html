<?php

namespace Yajra\DataTables\Html\Editor;

use Illuminate\Support\Fluent;

/**
 * @see https://editor.datatables.net/reference/type/form-options
 */
class FormOptions extends Fluent
{
    /**
     * @param  array  $attributes
     * @return static
     */
    public static function make(array $attributes = []): static
    {
        return new static($attributes);
    }

    /**
     * @param  int|string|null  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#focus
     */
    public function focus(int|string $value = null): static
    {
        $this->attributes['focus'] = $value;

        return $this;
    }

    /**
     * @param  bool  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#nest
     */
    public function nest(bool $value): static
    {
        $this->attributes['nest'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#onBackground
     */
    public function onBackground(string $value = 'blur'): static
    {
        $this->attributes['onBackground'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#onBlur
     */
    public function onBlur(string $value = 'close'): static
    {
        $this->attributes['onBlur'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#onComplete
     */
    public function onComplete(string $value = 'close'): static
    {
        $this->attributes['onComplete'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#onEsc
     */
    public function onEsc(string $value = 'close'): static
    {
        $this->attributes['onEsc'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#onFieldError
     */
    public function onFieldError(string $value = 'focus'): static
    {
        $this->attributes['onFieldError'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#onReturn
     */
    public function onReturn(string $value = 'submit'): static
    {
        $this->attributes['onReturn'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#submit
     */
    public function submit(string $value = 'changed'): static
    {
        $this->attributes['submit'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#scope
     */
    public function scope(string $value = 'row'): static
    {
        $this->attributes['scope'] = $value;

        return $this;
    }

    /**
     * @param  array|string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#buttons
     */
    public function buttons(array|string $value): static
    {
        $this->attributes['buttons'] = $value;

        return $this;
    }
    /**
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#drawType
     */
    public function drawType(string $value = ''): static
    {
        $this->attributes['drawType'] = $value;

        return $this;
    }

    /**
     * @param  bool|string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#message
     */
    public function message(bool|string $value = ''): static
    {
        $this->attributes['message'] = $value;

        return $this;
    }

    /**
     * @param  int|string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#submitTrigger
     */
    public function submitTrigger(int|string $value): static
    {
        $this->attributes['submitTrigger'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#submitHtml
     */
    public function submitHtml(string $value): static
    {
        $this->attributes['submitHtml'] = $value;

        return $this;
    }

    /**
     * @param  bool|string  $value
     * @return $this
     * @see https://editor.datatables.net/reference/type/form-options#title
     */
    public function title(bool|string $value): static
    {
        $this->attributes['title'] = $value;

        return $this;
    }
}
