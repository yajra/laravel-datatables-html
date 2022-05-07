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
     * @param  int  $value
     * @return $this
     */
    public function focus(int $value = 0): static
    {
        $this->attributes['focus'] = $value;

        return $this;
    }

    /**
     * @param  bool  $value
     * @return $this
     */
    public function message(bool $value = false): static
    {
        $this->attributes['message'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function onBackground(string $value = 'blur'): static
    {
        $this->attributes['onBackground'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function onBlur(string $value = 'close'): static
    {
        $this->attributes['onBlur'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function onComplete(string $value = 'close'): static
    {
        $this->attributes['onComplete'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function onEsc(string $value = 'close'): static
    {
        $this->attributes['onEsc'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function onFieldError(string $value = 'focus'): static
    {
        $this->attributes['onFieldError'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function onReturn(string $value = 'submit'): static
    {
        $this->attributes['onReturn'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function submit(string $value = 'changed'): static
    {
        $this->attributes['submit'] = $value;

        return $this;
    }

    /**
     * @param  bool  $value
     * @return $this
     */
    public function title(bool $value = false): static
    {
        $this->attributes['title'] = $value;

        return $this;
    }

    /**
     * @param  bool  $value
     * @return $this
     */
    public function drawType(bool $value = false): static
    {
        $this->attributes['drawType'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function scope(string $value = 'row'): static
    {
        $this->attributes['scope'] = $value;

        return $this;
    }
}
