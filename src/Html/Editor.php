<?php

namespace Yajra\DataTables\Html;

class Editor
{
    /**
     * @var string
     */
    public $instance = '';

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
    public $template = '';

    /**
     * @var string
     */
    public $fields = '';

    /**
     * @var array
     */
    public $language = [];

    /**
     * Editor constructor.
     *
     * @param string $instance
     */
    public function __construct(string $instance = 'editor')
    {
        $this->instance = $instance;
    }

    /**
     * Set Editor's variable name / instance.
     *
     * @param $instance
     * @return $this
     */
    public function instance($instance)
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * Set Editor's ajax parameter.
     *
     * @param string|array $ajax
     * @return $this
     */
    public function ajax($ajax)
    {
        $this->ajax = $ajax;

        return $this;
    }

    /**
     * Set Editor's table source.
     *
     * @param string $table
     * @return $this
     */
    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Set Editor's fields.
     *
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Set Editor's language.
     *
     * @param array $language
     * @return $this
     */
    public function language(array $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Set Editor's template.
     *
     * @param string $template
     * @return $this
     */
    public function template($template)
    {
        $this->template = $template;

        return $this;
    }
}
