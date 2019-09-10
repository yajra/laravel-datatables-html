<?php

namespace Yajra\DataTables\Html\Editor\Fields;

/**
 * @see https://editor.datatables.net/reference/field/upload
 * @see https://editor.datatables.net/examples/advanced/upload.html
 * @see https://editor.datatables.net/examples/advanced/upload-many.html
 */
class Image extends File
{
    protected $type = 'upload';

    /**
     * @param string $name
     * @param string $label
     * @return \Yajra\DataTables\Html\Editor\Fields\File
     */
    public static function make($name, $label = '')
    {
        return parent::make($name, $label)->displayImage();
    }
}
