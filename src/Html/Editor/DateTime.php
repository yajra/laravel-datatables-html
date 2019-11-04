<?php

namespace Yajra\DataTables\Html\Editor;

class DateTime extends Field
{
    protected $type = 'datetime';

    /**
     * Make a new instance of a field.
     *
     * @param string $name
     * @param string $label
     * @return Field|\DateTime
     */
    public static function make($name, $label = '')
    {
        return parent::make($name, $label)->format('YYYY-MM-DD hh:mm a');
    }

    /**
     * Set format to military time (24 hrs).
     *
     * @return Field|Time
     */
    public function military()
    {
        return $this->format('YYYY-MM-DD HH:mm');
    }
}
