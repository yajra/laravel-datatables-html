<?php

namespace Yajra\DataTables\Html\Editor\Fields;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BelongsTo extends Select
{
    /**
     * @param  class-string<\Illuminate\Database\Eloquent\Model>|Builder  $class
     * @param  string  $text
     * @param  string  $id
     * @param  string|null  $foreign
     * @return static
     */
    public static function model(Builder|string $class, string $text, string $id = 'id', string $foreign = null): static
    {
        if ($class instanceof Builder) {
            $table = $class->getModel()->getTable();
        } else {
            $class = new $class;
            $table = $class->getTable();
        }

        $table = Str::singular($table);
        $foreign = $foreign ?? $table.'_id';

        return self::make($foreign, Str::title($table))
                   ->modelOptions($class, $text, $id);
    }
}
