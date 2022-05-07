<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class Time extends DateTime
{
    /**
     * Make a new instance of a field.
     *
     * @param  array|string  $name
     * @param  string  $label
     * @return static
     */
    public static function make(array|string $name, string $label = ''): static
    {
        /** @var \Yajra\DataTables\Html\Editor\Fields\Time $field */
        $field = parent::make($name, $label);

        return $field->format('hh:mm a');
    }

    /**
     * Set format to military time (24 hrs).
     *
     * @return $this
     */
    public function military(): static
    {
        return $this->format('HH:mm');
    }
}
