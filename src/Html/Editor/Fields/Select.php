<?php

namespace Yajra\DataTables\Html\Editor\Fields;

/**
 * @see https://editor.datatables.net/reference/field/select
 */
class Select extends Field
{
    protected $type = 'select';

    /**
     * Set field multiple value.
     *
     * @param  bool  $value
     * @return $this
     */
    public function multiple(bool $value = true)
    {
        $this->attributes['multiple'] = $value;

        return $this;
    }

    /**
     * Set field optionsPair value.
     *
     * @param  string|array  $label
     * @param  string  $value
     * @return $this
     */
    public function optionsPair($label = 'label', $value = 'value')
    {
        if (is_array($label)) {
            $this->attributes['optionsPair'] = $label;
        } else {
            $this->attributes['optionsPair']['label'] = $label;
            $this->attributes['optionsPair']['value'] = $value;
        }

        return $this;
    }

    /**
     * Set field placeholder value.
     *
     * @param  string  $value
     * @return $this
     */
    public function placeholder($value)
    {
        $this->attributes['placeholder'] = $value;

        return $this;
    }

    /**
     * Set field placeholderDisabled value.
     *
     * @param  bool  $value
     * @return $this
     */
    public function placeholderDisabled(bool $value)
    {
        $this->attributes['placeholderDisabled'] = $value;

        return $this;
    }

    /**
     * Set field placeholderValue value.
     *
     * @param  string  $value
     * @return $this
     */
    public function placeholderValue($value)
    {
        $this->attributes['placeholderValue'] = $value;

        return $this;
    }
}
