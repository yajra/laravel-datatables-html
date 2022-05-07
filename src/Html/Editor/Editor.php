<?php

namespace Yajra\DataTables\Html\Editor;

use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Editor\Fields\Field;
use Yajra\DataTables\Html\HasAuthorizations;
use Yajra\DataTables\Utilities\Helper;

/**
 * @property string|null $table
 * @property string|array|null $ajax
 */
class Editor extends Fluent
{
    use HasEvents;
    use HasAuthorizations;

    const DISPLAY_LIGHTBOX = 'lightbox';
    const DISPLAY_ENVELOPE = 'envelope';
    const DISPLAY_BOOTSTRAP = 'bootstrap';
    const DISPLAY_FOUNDATION = 'foundation';
    const DISPLAY_JQUERYUI = 'jqueryui';

    /**
     * Editor constructor.
     *
     * @param  string|array  $instance
     */
    public function __construct($instance = 'editor')
    {
        $attributes['instance'] = $instance;

        parent::__construct($attributes);
    }

    /**
     * Make new Editor instance.
     *
     * @param  array|string  $instance
     * @return static
     */
    public static function make(array|string $instance = 'editor'): static
    {
        if (is_array($instance)) {
            $instance = $instance['editor'] ?? 'editor';
        }

        return new static($instance);
    }

    /**
     * Append raw scripts.
     *
     * @param  string  $scripts
     * @return $this
     */
    public function scripts(string $scripts): static
    {
        $this->attributes['scripts'] = $scripts;

        return $this;
    }

    /**
     * Set Editor's variable name / instance.
     *
     * @param  string  $instance
     * @return $this
     */
    public function instance(string $instance): static
    {
        $this->attributes['instance'] = $instance;

        return $this;
    }

    /**
     * Set Editor's ajax parameter.
     *
     * @param  array|string  $ajax
     * @return $this
     * @see https://editor.datatables.net/reference/option/ajax
     */
    public function ajax(array|string $ajax): static
    {
        $this->attributes['ajax'] = $ajax;

        return $this;
    }

    /**
     * Set Editor's table source.
     *
     * @param  string  $table
     * @return $this
     * @see https://editor.datatables.net/reference/option/table
     */
    public function table(string $table): static
    {
        $this->attributes['table'] = $table;

        return $this;
    }

    /**
     * Set Editor's idSrc option.
     *
     * @param  string  $idSrc
     * @return $this
     * @see https://editor.datatables.net/reference/option/idSrc
     */
    public function idSrc(string $idSrc = 'DT_RowId'): static
    {
        $this->attributes['idSrc'] = $idSrc;

        return $this;
    }

    /**
     * Set Editor's display option.
     *
     * @param  string  $display
     * @return $this
     * @see https://editor.datatables.net/reference/option/display
     */
    public function display(string $display): static
    {
        $this->attributes['display'] = $display;

        return $this;
    }

    /**
     * Set Editor's fields.
     *
     * @param  array  $fields
     * @return $this
     * @see https://editor.datatables.net/reference/option/fields
     */
    public function fields(array $fields): static
    {
        $this->attributes['fields'] = $fields;

        return $this;
    }

    /**
     * Set Editor's formOptions.
     *
     * @param  array  $formOptions
     * @return $this
     * @see https://editor.datatables.net/reference/option/formOptions
     * @see https://editor.datatables.net/reference/type/form-options
     */
    public function formOptions(array $formOptions): static
    {
        $this->attributes['formOptions'] = $formOptions;

        return $this;
    }

    /**
     * Set Editor's bubble formOptions.
     *
     * @param  array  $formOptions
     * @return $this
     * @throws \Yajra\DataTables\Exceptions\Exception
     * @see https://editor.datatables.net/reference/option/formOptions.bubble
     */
    public function formOptionsBubble(array $formOptions): static
    {
        $this->attributes['formOptions']['bubble'] = Helper::castToArray($formOptions);;

        return $this;
    }

    /**
     * Set Editor's inline formOptions.
     *
     * @param  array  $formOptions
     * @return $this
     * @throws \Yajra\DataTables\Exceptions\Exception
     * @see https://editor.datatables.net/reference/option/formOptions.inline
     */
    public function formOptionsInline(array $formOptions): static
    {
        $this->attributes['formOptions']['inline'] = Helper::castToArray($formOptions);

        return $this;
    }

    /**
     * Set Editor's main formOptions.
     *
     * @param  array  $formOptions
     * @return $this
     * @throws \Yajra\DataTables\Exceptions\Exception
     * @see https://editor.datatables.net/reference/option/formOptions.main
     */
    public function formOptionsMain(array $formOptions): static
    {
        $this->attributes['formOptions']['main'] = Helper::castToArray($formOptions);

        return $this;
    }

    /**
     * Set Editor's language.
     *
     * @param  array  $language
     * @return $this
     * @see https://editor.datatables.net/reference/option/i18n
     */
    public function language(array $language): static
    {
        $this->attributes['i18n'] = $language;

        return $this;
    }

    /**
     * Set Editor's template.
     *
     * @param  string  $template
     * @return $this
     * @see https://editor.datatables.net/reference/option/template
     */
    public function template(string $template): static
    {
        $this->attributes['template'] = $template;

        return $this;
    }

    /**
     * Convert the fluent instance to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $array = parent::toArray();

        unset($array['events']);

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
    public function toJson($options = 0): string
    {
        $parameters = $this->jsonSerialize();

        unset($parameters['events']);

        $values = [];
        $replacements = [];

        foreach (Arr::dot($parameters) as $key => $value) {
            if ($this->isCallbackFunction($value, $key)) {
                $values[] = trim($value);
                Arr::set($parameters, $key, '%'.$key.'%');
                $replacements[] = '"%'.$key.'%"';
            }
        }

        $new = [];
        foreach ($parameters as $key => $value) {
            Arr::set($new, $key, $value);
        }

        $json = (string) json_encode($new, $options);

        return str_replace($replacements, $values, $json);
    }

    /**
     * Check if given key & value is a valid callback js function.
     *
     * @param  string  $value
     * @param  string  $key
     * @return bool
     */
    protected function isCallbackFunction(string $value, string $key): bool
    {
        if (empty($value)) {
            return false;
        }

        $callbacks = config('datatables-html.callback', ['$', '$.', 'function']);

        return Str::startsWith(trim($value), $callbacks) || Str::contains($key, ['editor', 'minDate', 'maxDate']);
    }
}
