<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class Boolean extends Checkbox
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
        return parent::make($name, $label)->separator(',')->options(
            Options::make()->append('', 1)
        );
    }
}
