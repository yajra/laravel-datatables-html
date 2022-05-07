<?php

namespace Yajra\DataTables\Html\Editor\Fields;

/**
 * @see https://editor.datatables.net/reference/field/select
 */
class Select extends Field
{
    protected string $type = 'select';

    /**
     * Set field multiple value.
     *
     * @param  bool  $value
     * @return $this
     */
    public function multiple(bool $value = true): static
    {
        $this->attributes['multiple'] = $value;

        return $this;
    }

    /**
     * Set field optionsPair value.
     *
     * @param  array|string  $label
     * @param  string  $value
     * @return $this
     */
    public function optionsPair(array|string $label = 'label', string $value = 'value'): static
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
    public function placeholder(string $value): static
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
    public function placeholderDisabled(bool $value): static
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
    public function placeholderValue(string $value): static
    {
        $this->attributes['placeholderValue'] = $value;

        return $this;
    }
}
