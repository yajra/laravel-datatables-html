<?php

namespace Yajra\DataTables\Html\Columns;

use Yajra\DataTables\Html\Column;

trait Index
{
    /**
     * Add a index column.
     *
     * @param  array $attributes
     * @return $this
     */
    public function addIndex(array $attributes = [])
    {
        $indexColumn = $this->config->get('datatables.index_column', 'DT_RowIndex');

        $attributes = array_merge([
            'defaultContent' => '',
            'data'           => $indexColumn,
            'name'           => $indexColumn,
            'title'          => '',
            'render'         => null,
            'orderable'      => false,
            'searchable'     => false,
            'exportable'     => false,
            'printable'      => true,
            'footer'         => '',
        ], $attributes);

        $this->collection->push(new Column($attributes));

        return $this;
    }
}
