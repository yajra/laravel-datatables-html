<?php

namespace Yajra\DataTables\Html\Editor;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Editor\Fields\Field;

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
        $this->attributes['i18n'] = $language;

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

    /**
     * Convert the fluent instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        foreach (Arr::get($array, 'fields', []) as $key => &$field) {
            if ($field instanceof Field) {
                Arr::set($array['fields'], $key, $field->toArray());
            }
        }

        return $array;
    }

    /**
     * Convert the fluent instance to JSON.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        $parameters = $this->jsonSerialize();

        $values = [];
        $replacements = [];

        foreach (array_dot($parameters) as $key => $value) {
            if ($key === 'table') {
                array_set($parameters, $key, '#' . $value);
            }

            if ($this->isCallbackFunction($value, $key)) {
                $values[] = trim($value);
                array_set($parameters, $key, '%' . $key . '%');
                $replacements[] = '"%' . $key . '%"';
            }
        }

        $new = [];
        foreach ($parameters as $key => $value) {
            array_set($new, $key, $value);
        }

        $json = json_encode($new, $options);

        $json = str_replace($replacements, $values, $json);

        return $json;
    }

    /**
     * Check if given key & value is a valid callback js function.
     *
     * @param string $value
     * @param string $key
     * @return bool
     */
    protected function isCallbackFunction($value, $key)
    {
        if (empty($value) || is_object($value) || is_array($value)) {
            return false;
        }

        $callbacks = config('datatables-html.callback', ['$', '$.', 'function']);

        return Str::startsWith(trim($value), $callbacks) || Str::contains($key, ['editor', 'minDate', 'maxDate']);
    }
}
