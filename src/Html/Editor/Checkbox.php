<?php

namespace Yajra\DataTables\Html\Editor;

class Checkbox extends Field
{
    protected $type = 'checkbox';

    /**
     * Set checkbox separator.
     *
     * @param string $separator
     * @return $this
     */
    public function separator($separator = ',')
    {
        $this->attributes['separator'] = $separator;

        return $this;
    }
}
