<?php

namespace Yajra\DataTables\Html\Editor;

use Illuminate\Support\Fluent;

/**
 * @see https://editor.datatables.net/reference/type/form-options
 */
class FormOptions extends Fluent
{
    /**
     * @param array $attributes
     * @return \Yajra\DataTables\Html\Editor\FormOptions
     */
    public static function make($attributes = [])
    {
        return new static($attributes);
    }

    /**
     * @param int $value
     * @return $this
     */
    public function focus($value = 0)
    {
        $this->attributes['focus'] = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function message($value = false)
    {
        $this->attributes['message'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function onBackground($value = 'blur')
    {
        $this->attributes['onBackground'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function onBlur($value = 'close')
    {
        $this->attributes['onBlur'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function onComplete($value = 'close')
    {
        $this->attributes['onComplete'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function onEsc($value = 'close')
    {
        $this->attributes['onEsc'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function onFieldError($value = 'focus')
    {
        $this->attributes['onFieldError'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function onReturn($value = 'submit')
    {
        $this->attributes['onReturn'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function submit($value = 'changed')
    {
        $this->attributes['submit'] = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function title($value = false)
    {
        $this->attributes['title'] = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function drawType($value = false)
    {
        $this->attributes['drawType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function scope($value = 'row')
    {
        $this->attributes['scope'] = $value;

        return $this;
    }
}
