<?php

namespace Yajra\DataTables\Html;

class Editor
{
    /**
     * @var string
     */
    public $instance = 'editor';

    /**
     * @var string
     */
    public $ajax = '';

    /**
     * @var string
     */
    public $table = '';

    /**
     * @var string
     */
    public $fields = '';

    /**
     * @var array
     */
    public $language = [];

    /**
     * @param $instance
     * @return $this
     */
    public function instance($instance)
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * @param string|array $ajax
     * @return $this
     */
    public function ajax($ajax)
    {
        $this->ajax = $ajax;

        return $this;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @param array $language
     * @return $this
     */
    public function language(array $language)
    {
        $this->language = $language;

        return $this;
    }
}
