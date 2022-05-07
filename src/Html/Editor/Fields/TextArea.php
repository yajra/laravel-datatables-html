<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class TextArea extends Field
{
    protected string $type = 'textarea';

    /**
     * @param  int  $value
     * @return static
     */
    public function rows(int $value): static
    {
        return $this->attr('rows', $value);
    }

    /**
     * @param  int  $value
     * @return static
     */
    public function cols(int $value): static
    {
        return $this->attr('cols', $value);
    }
}
