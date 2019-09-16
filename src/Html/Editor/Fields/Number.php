<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class Number extends Field
{
    public static function make($name, $label = '')
    {
        return parent::make($name, $label)->attr('type', 'number');
    }
}
