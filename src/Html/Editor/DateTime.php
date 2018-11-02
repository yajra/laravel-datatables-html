<?php

namespace Yajra\DataTables\Html\Editor;

class DateTime extends Field
{
    protected $type = 'datetime';

    public function format($format)
    {
        $this->attributes['format'] = $format;

        return $this;
    }
}
