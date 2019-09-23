<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class Time extends DateTime
{
    /**
     * Make a new instance of a field.
     *
     * @param string $name
     * @param string $label
     * @return static|\Yajra\DataTables\Html\Editor\Fields\File
     */
    public static function make($name, $label = '')
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
    public function military()
    {
        return $this->format('HH:mm');
    }
}
