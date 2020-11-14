<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;
use Illuminate\Contracts\Support\Arrayable;

class Button extends Fluent implements Arrayable
{
    use HasAuthorizations;

    /**
     * Make a new button instance.
     *
     * @param string|array $options
     * @return static
     */
    public static function make($options = [])
    {
        if (is_string($options)) {
            return new static(['extend' => $options]);
        }

        return new static($options);
    }

    /**
     * Make a raw button that does not extend anything.
     *
     * @param array $options
     * @return static
     */
    public static function raw($options = [])
    {
        if (is_string($options)) {
            return new static(['text' => $options]);
        }

        return new static($options);
    }

    /**
     * Set attr option value.
     *
     * @param array $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.attr
     */
    public function attr(array $value)
    {
        $this->attributes['attr'] = $value;

        return $this;
    }

    /**
     * Set available option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.available
     */
    public function available($value)
    {
        if ($this->isFunction($value)) {
            $this->attributes['available'] = $value;
        } else {
            $this->attributes['available'] = "function(dt, config) { $value }";
        }

        return $this;
    }

    /**
     * Check if a given value is a function.
     *
     * @param string $value
     * @return bool
     */
    protected function isFunction($value)
    {
        return substr($value, 0, 8) == 'function';
    }

    /**
     * Set enabled option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.enabled
     */
    public function enabled($value = true)
    {
        $this->attributes['enabled'] = $value;

        return $this;
    }

    /**
     * Set init option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.init
     */
    public function init($value)
    {
        if ($this->isFunction($value)) {
            $this->attributes['init'] = $value;
        } else {
            $this->attributes['init'] = "function(dt, node, config) { $value }";
        }

        return $this;
    }

    /**
     * Set key option value.
     *
     * @param string|array $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.key
     */
    public function key($value)
    {
        $this->attributes['key'] = $value;

        return $this;
    }

    /**
     * Set extend option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.extend
     */
    public function extend($value)
    {
        $this->attributes['extend'] = $value;

        return $this;
    }

    /**
     * Set editor option value.
     *
     * @param string $value
     * @return $this
     * @see https://editor.datatables.net/reference/button
     */
    public function editor($value)
    {
        $this->attributes['editor'] = $value;

        return $this;
    }

    /**
     * Set buttons option value.
     *
     * @param array $buttons
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons
     */
    public function buttons(array $buttons)
    {
        foreach ($buttons as $key => $button) {
            if ($button instanceof Arrayable) {
                $buttons[$key] = $button->toArray();
            }
        }

        $this->attributes['buttons'] = $buttons;

        return $this;
    }

    /**
     * @param array $buttons
     * @return $this
     * @see https://editor.datatables.net/examples/api/cancelButton
     */
    public function formButtons(array $buttons)
    {
        foreach ($buttons as $key => $button) {
            if ($button instanceof Arrayable) {
                $buttons[$key] = $button->toArray();
            }
        }

        $this->attributes['formButtons'] = $buttons;

        return $this;
    }

    /**
     * @param mixed $message
     * @return $this
     * @see https://editor.datatables.net/examples/api/removeMessage
     * @see https://editor.datatables.net/reference/button/create
     * @see https://editor.datatables.net/reference/button/edit
     * @see https://editor.datatables.net/reference/button/remove
     */
    public function formMessage($message)
    {
        $this->attributes['formMessage'] = $message;

        return $this;
    }

    /**
     * @param mixed $title
     * @return $this
     * @see https://editor.datatables.net/reference/button/create
     * @see https://editor.datatables.net/reference/button/edit
     * @see https://editor.datatables.net/reference/button/remove
     */
    public function formTitle($title)
    {
        $this->attributes['formTitle'] = $title;

        return $this;
    }

    /**
     * Set className option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.className
     */
    public function className($value)
    {
        $this->attributes['className'] = $value;

        return $this;
    }

    /**
     * Set destroy option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.destroy
     */
    public function destroy($value)
    {
        if ($this->isFunction($value)) {
            $this->attributes['destroy'] = $value;
        } else {
            $this->attributes['destroy'] = "function(dt, node, config) { $value }";
        }

        return $this;
    }

    /**
     * Set customize option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/button/excelHtml5
     */
    public function customize($value)
    {
        $this->attributes['customize'] = $value;

        return $this;
    }

    /**
     * Append a class name to column.
     *
     * @param string $class
     * @return $this
     */
    public function addClass($class)
    {
        if (! isset($this->attributes['className'])) {
            $this->attributes['className'] = $class;
        } else {
            $this->attributes['className'] .= " $class";
        }

        return $this;
    }

    /**
     * Set text option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.text
     */
    public function text($value)
    {
        $this->attributes['text'] = $value;

        return $this;
    }

    /**
     * Set titleAttr option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.titleAttr
     */
    public function titleAttr($value)
    {
        $this->attributes['titleAttr'] = $value;

        return $this;
    }

    /**
     * Set name option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.name
     */
    public function name($value)
    {
        $this->attributes['name'] = $value;

        return $this;
    }

    /**
     * Set namespace option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.namespace
     */
    public function namespace($value)
    {
        $this->attributes['namespace'] = $value;

        return $this;
    }

    /**
     * Set tag option value.
     *
     * @param string $value
     * @return $this
     * @see https://datatables.net/reference/option/buttons.buttons.tag
     */
    public function tag($value)
    {
        $this->attributes['tag'] = $value;

        return $this;
    }

    /**
     * Set columns option value.
     *
     * @param mixed $value
     * @return $this
     */
    public function columns($value)
    {
        $this->attributes['columns'] = $value;

        return $this;
    }

    /**
     * Set exportOptions option value.
     *
     * @param mixed $value
     * @return $this
     */
    public function exportOptions($value)
    {
        $this->attributes['exportOptions'] = $value;

        return $this;
    }

    /**
     * Set action to submit the form.
     *
     * @return \Yajra\DataTables\Html\Button
     */
    public function actionSubmit()
    {
        $this->attributes['action'] = 'function() { this.submit(); }';

        return $this;
    }

    /**
     * Set action option value.
     *
     * @param string $value
     * @return $this
     */
    public function action($value)
    {
        if (substr($value, 0, 8) == 'function') {
            $this->attributes['action'] = $value;
        } else {
            $this->attributes['action'] = "function(e, dt, node, config) { $value }";
        }

        return $this;
    }

    /**
     * Set editor class action handler.
     *
     * @param string $action
     * @return \Yajra\DataTables\Html\Button
     */
    public function actionHandler($action)
    {
        $this->attributes['action'] = "function() { this.submit(null, null, function(data) { data.action = '{$action}'; return data; }) }";

        return $this;
    }

    /**
     * Set action to close the form.
     *
     * @return \Yajra\DataTables\Html\Button
     */
    public function actionClose()
    {
        $this->attributes['action'] = 'function() { this.close(); }';

        return $this;
    }

    /**
     * Set button alignment.
     *
     * @param string $align
     * @return \Yajra\DataTables\Html\Button
     */
    public function align($align = 'button-left')
    {
        $this->attributes['align'] = $align;

        return $this;
    }
}
