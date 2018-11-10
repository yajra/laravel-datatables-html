<?php

namespace Yajra\DataTables\Html\Editor;

class Boolean extends Select
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
        return parent::make($name, $label)->options(Options::trueFalse());
    }
}
