<?php

namespace Yajra\DataTables\Html\Editor;

use Illuminate\Support\Fluent;

class Editor extends Fluent
{
    use HasEvents;

    const DISPLAY_LIGHTBOX = 'lightbox';
    const DISPLAY_ENVELOPE = 'envelope';
    const DISPLAY_BOOTSTRAP = 'bootstrap';
    const DISPLAY_FOUNDATION = 'foundation';
    const DISPLAY_JQUERYUI = 'jqueryui';

    /**
     * Editor constructor.
     *
     * @param string $instance
     */
    public function __construct($instance = 'editor')
    {
        $attributes['instance'] = $instance;

        parent::__construct($attributes);
    }

    /**
     * Make new Editor instance.
     *
     * @param string $instance
     * @return Editor
     */
    public static function make($instance = 'editor')
    {
        return new static($instance);
    }

    /**
     * Append raw scripts.
     *
     * @param string $scripts
     * @return Editor
     */
    public function scripts($scripts)
    {
        $this->attributes['scripts'] = $scripts;

        return $this;
    }

    /**
     * Set Editor's variable name / instance.
     *
     * @param $instance
     * @return $this
     */
    public function instance($instance)
    {
        $this->attributes['instance'] = $instance;

        return $this;
    }

    /**
     * Set Editor's ajax parameter.
     *
     * @param string|array $ajax
     * @return $this
     * @see https://editor.datatables.net/reference/option/ajax
     */
    public function ajax($ajax)
    {
        $this->attributes['ajax'] = $ajax;

        return $this;
    }

    /**
     * Set Editor's table source.
     *
     * @param string $table
     * @return $this
     * @see https://editor.datatables.net/reference/option/table
     */
    public function table($table)
    {
        $this->attributes['table'] = $table;

        return $this;
    }

    /**
     * Set Editor's idSrc option.
     *
     * @param string $idSrc
     * @return $this
     * @see https://editor.datatables.net/reference/option/idSrc
     */
    public function idSrc($idSrc = 'DT_RowId')
    {
        $this->attributes['idSrc'] = $idSrc;

        return $this;
    }

    /**
     * Set Editor's display option.
     *
     * @param string $display
     * @return $this
     * @see https://editor.datatables.net/reference/option/display
     */
    public function display($display)
    {
        $this->attributes['display'] = $display;

        return $this;
    }

    /**
     * Set Editor's fields.
     *
     * @param array $fields
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields
     */
    public function fields(array $fields)
    {
        $this->attributes['fields'] = $fields;

        return $this;
    }

    /**
     * Set Editor's language.
     *
     * @param array $language
     * @return $this
     * @see https://editor.datatables.net/reference/option/i18n
     */
    public function language(array $language)
    {
        $this->attributes['language'] = $language;

        return $this;
    }

    /**
     * Set Editor's template.
     *
     * @param string $template
     * @return $this
     * @see https://editor.datatables.net/reference/option/template
     */
    public function template($template)
    {
        $this->attributes['template'] = $template;

        return $this;
    }
}
