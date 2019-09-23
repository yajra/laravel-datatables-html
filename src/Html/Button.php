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
     * @return Button
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
     * @return \Yajra\DataTables\Html\Button
     */
    public static function raw($options = [])
    {
        if (is_string($options)) {
            return new static(['text' => $options]);
        }

        return new static($options);
    }

    /**
     * Set extend option value.
     *
     * @param string $value
     * @return $this
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
     */
    public function editor($value)
    {
        $this->attributes['editor'] = $value;

        return $this;
    }

    /**
     * @param array $buttons
     * @return $this
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
     * Set className option value.
     *
     * @param string $value
     * @return $this
     */
    public function className($value)
    {
        $this->attributes['className'] = $value;

        return $this;
    }

    /**
     * Set text option value.
     *
     * @param string $value
     * @return $this
     */
    public function text($value)
    {
        $this->attributes['text'] = $value;

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
        return $this->action('function() { this.submit(); }');
    }

    /**
     * Set action option value.
     *
     * @param string $value
     * @return $this
     */
    public function action($value)
    {
        $this->attributes['action'] = $value;

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
        return $this->action("function() { this.submit(null, null, function(data) { data.action = '{$action}'; return data; }) }");
    }

    /**
     * Set action to close the form.
     *
     * @return \Yajra\DataTables\Html\Button
     */
    public function actionClose()
    {
        return $this->action('function() { this.close(); }');
    }
}
