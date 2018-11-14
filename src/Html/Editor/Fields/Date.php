<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class Date extends DateTime
{
    /**
     * Make a new instance of a field.
     *
     * @param string $name
     * @param string $label
     * @return Field
     */
    public static function make($name, $label = '')
    {
        return parent::make($name, $label)->format('YYYY-MM-DD');
    }
}
