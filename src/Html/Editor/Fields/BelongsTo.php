<?php

namespace Yajra\DataTables\Html\Editor\Fields;

use Illuminate\Support\Str;

class BelongsTo extends Select
{
    /**
     * @param string $class
     * @param string $text
     * @param string $id
     * @param string|null $foreign
     * @return \Yajra\DataTables\Html\Editor\Fields\Field|static
     */
    public static function model($class, $text, $id = 'id', $foreign = null)
    {
        $table   = Str::singular(app($class)->getTable());
        $foreign = $foreign ?? $table . '_id';

        return self::make($foreign, Str::title($table))
                   ->modelOptions($class, $text, $id);
    }

    /**
     * Add a placeholder and allow clear.
     * Note: This requires editor select2 plugin.
     *
     * @see https://editor.datatables.net/plug-ins/field-type/editor.select2
     * @param string $text
     * @param null|string $id
     * @param bool $allowClear
     * @return $this
     */
    public function placeholder($text, $id = null, $allowClear = true)
    {
        $this->type('select2')
             ->opts([
                 'allowClear'  => $allowClear,
                 'placeholder' => [
                     'id'   => $id,
                     'text' => $text,
                 ],
             ]);

        return $this;
    }
}
