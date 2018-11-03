<?php

namespace Yajra\DataTables\Html\Editor;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Options extends Collection
{
    /**
     * Return a Yes/No options.
     *
     * @return Options
     */
    public static function yesNo()
    {
        $data = [
            ['label' => __('Yes'), 'value' => true],
            ['label' => __('No'), 'value' => false],
        ];

        return new static($data);
    }

    /**
     * Get options from a model.
     *
     * @param mixed $model
     * @param string $value
     * @param string $key
     * @return Collection
     */
    public static function model($model, $value, $key = 'id')
    {
        if (!$model instanceof Builder) {
            $model = $model::query();
        }

        return $model->get()->map(function($model) use($value, $key) {
            return [
                'value' => $model->{$key},
                'label' => $model->{$value}
            ];
        });
    }

    /**
     * Return a True/False options.
     *
     * @return Options
     */
    public static function trueFalse()
    {
        $data = [
            ['label' => __('True'), 'value' => true],
            ['label' => __('False'), 'value' => false],
        ];

        return new static($data);
    }

    /**
     * Push an item onto the end of the collection.
     *
     * @param mixed $value
     * @param mixed $key
     * @return Options
     */
    public function append($value, $key)
    {
        return $this->push(['label' => $value, 'value' => $key]);
    }

    /**
     * Push an item onto the beginning of the collection.
     *
     * @param  mixed $value
     * @param  mixed $key
     * @return $this
     */
    public function prepend($value, $key = null)
    {
        $data = ['label' => $value, 'value' => $key];

        return parent::prepend($data);
    }
}
