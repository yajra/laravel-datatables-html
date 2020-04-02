<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class TextArea extends Field
{
    protected $type = 'textarea';

    /**
     * @param int $value
     * @return static
     */
    public function rows($value)
    {
        return $this->attr('rows', $value);
    }

    /**
     * @param int $value
     * @return static
     */
    public function cols($value)
    {
        return $this->attr('cols', $value);
    }
}
