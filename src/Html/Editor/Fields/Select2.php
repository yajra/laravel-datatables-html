<?php

namespace Yajra\DataTables\Html\Editor\Fields;

/**
 * @see https://editor.datatables.net/plug-ins/field-type/editor.select2
 */
class Select2 extends Select
{
    protected string $type = 'select2';

    /**
     * @param  bool  $state
     * @return $this
     */
    public function allowClear(bool $state = true): static
    {
        $this->attributes['opts']['allowClear'] = $state;

        return $this;
    }

    /**
     * @param  string  $value
     * @param  string  $id
     * @return $this
     */
    public function optsPlaceholder(string $value = '', string $id = 'id'): static
    {
        $this->attributes['opts']['placeholder'] = [
            'id' => $id,
            'text' => $value,
        ];

        return $this;
    }

    /**
     * Set select2 ajax option.
     *
     * @param  array|string  $value
     * @return $this
     */
    public function ajax(array|string $value): static
    {
        if (is_array($value)) {
            $this->attributes['opts']['ajax'] = $value;
        } else {
            $this->attributes['opts']['ajax']['url'] = $value;
        }

        return $this;
    }

    /**
     * Set select2 ajax url option.
     *
     * @param  string  $value
     * @return $this
     */
    public function ajaxUrl(string $value): static
    {
        $this->attributes['opts']['ajax']['url'] = $value;

        return $this;
    }

    /**
     * Set select2 ajaxDelay option.
     *
     * @param  int  $value
     * @return $this
     */
    public function ajaxDelay(int $value = 250): static
    {
        $this->attributes['opts']['ajax']['delay'] = $value;

        return $this;
    }

    /**
     * Set select2 ajax data option.
     *
     * @param  array|string  $data
     * @return $this
     */
    public function ajaxData(array|string $data): static
    {
        if (is_array($data)) {
            $script = 'function(params) {';
            foreach ($data as $key => $value) {
                $value = json_encode($value);
                $script .= " params.{$key} = {$value}; ";
            }
            $script .= 'return params; }';

            $data = $script;
        }

        $this->attributes['opts']['ajax']['data'] = $data;

        return $this;
    }

    /**
     * Set select2 ajax processResults option to process a paginated results.
     *
     * @param  string  $display
     * @param  string  $id
     * @return $this
     */
    public function processPaginatedResults(string $display = 'text', string $id = 'id'): static
    {
        $script = 'function(data, params) { ';
        $script .= 'params.page = params.page || 1; ';
        $script .= "data.data.map(function(e) { e.text = e.{$display}; e.id = e.{$id}; return e; }); ";
        $script .= 'return { results: data.data, pagination: { more: data.current_page < data.last_page } };';
        $script .= '}';

        return $this->processResults($script);
    }

    /**
     * Set select2 ajax processResults option.
     *
     * @param  string  $value
     * @return $this
     */
    public function processResults(string $value): static
    {
        $this->attributes['opts']['ajax']['processResults'] = $value;

        return $this;
    }
}
