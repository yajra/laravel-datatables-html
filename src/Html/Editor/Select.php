<?php

namespace Yajra\DataTables\Html\Editor;

class Select extends Field
{
    protected $type = 'select';

    /**
     * Set select options.
     *
     * @param array $options
     * @return $this
     */
    public function options(array $options)
    {
        $this->attributes['options'] = $options;

        return $this;
    }
}
