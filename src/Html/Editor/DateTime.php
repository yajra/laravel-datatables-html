<?php

namespace Yajra\DataTables\Html\Editor;

class DateTime extends Field
{
    protected $type = 'datetime';

    /**
     * Set dateTime format.
     *
     * @param string $format
     * @return $this
     */
    public function format($format)
    {
        $this->attributes['format'] = $format;

        return $this;
    }
}
