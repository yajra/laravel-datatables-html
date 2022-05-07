<?php

namespace Yajra\DataTables\Html\Editor\Fields;

/**
 * @see https://editor.datatables.net/reference/field/upload
 * @see https://editor.datatables.net/examples/advanced/upload.html
 * @see https://editor.datatables.net/examples/advanced/upload-many.html
 */
class Image extends File
{
    protected string $type = 'upload';

    /**
     * @param  array|string  $name
     * @param  string  $label
     * @return static
     */
    public static function make(array|string $name, string $label = ''): static
    {
        return parent::make($name, $label)->displayImage();
    }
}
