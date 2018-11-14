<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class Time extends DateTime
{
    /**
     * Make a new instance of a field.
     *
     * @param string $name
     * @param string $label
     * @return Field|Time
     */
    public static function make($name, $label = '')
    {
        return parent::make($name, $label)->format('hh:mm a');
    }

    /**
     * Set format to military time (24 hrs).
     *
     * @return Field|Time
     */
    public function military()
    {
        return $this->format('HH:mm');
    }
}
