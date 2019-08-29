<?php

namespace Yajra\DataTables\Html\Editor\Fields;

/**
 * @see https://editor.datatables.net/plug-ins/field-type/editor.select2
 */
class Select2 extends Select
{
    protected $type = 'select2';

    /**
     * @param bool $state
     * @return $this
     */
    public function allowClear($state = true)
    {
        $this->attributes['opts']['allowClear'] = $state;

        return $this;
    }

    /**
     * @param string $text
     * @param string|null $id
     * @return $this
     */
    public function placeholder($text = '', $id = null)
    {
        $this->attributes['opts']['placeholder'] = [
            'id'   => $id,
            'text' => $text,
        ];

        return $this;
    }
}
