<?php

namespace Yajra\DataTables\Html\Options;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * DataTables - Data option builder.
 *
 * @property \Illuminate\Contracts\Config\Repository $config
 *
 * @see https://datatables.net/reference/option/
 */
trait HasData
{
    /**
     * @var string|array
     */
    protected string|array $ajax = '';

    /**
     * Setup "ajax" parameter with POST method.
     *
     * @param  array|string  $attributes
     * @return $this
     */
    public function postAjax(array|string $attributes = ''): static
    {
        if (! is_array($attributes)) {
            $attributes = ['url' => (string) $attributes];
        }

        unset($attributes['method']);
        Arr::set($attributes, 'type', 'POST');
        Arr::set($attributes, 'headers.X-HTTP-Method-Override', 'GET');

        return $this->ajax($attributes);
    }

    /**
     * Setup ajax parameter.
     *
     * @param  array|string  $attributes
     * @return $this
     */
    public function ajax(array|string $attributes = ''): static
    {
        $this->ajax = $attributes;

        return $this;
    }

    /**
     * Setup ajax parameter for datatables pipeline plugin.
     *
     * @param  string  $url
     * @param  string  $pages
     * @return $this
     */
    public function pipeline(string $url, string $pages): static
    {
        return $this->ajax("$.fn.dataTable.pipeline({ url: '$url', pages: $pages })");
    }

    /**
     * Get ajax url.
     *
     * @return string
     */
    public function getAjaxUrl(): string
    {
        if (is_array($this->ajax)) {
            return $this->ajax['url'] ?: url()->current();
        }

        return $this->ajax ?: url()->current();
    }

    /**
     * Set ajax url with data added from form.
     *
     * @param  string  $url
     * @param  string  $formSelector
     * @return $this
     */
    public function ajaxWithForm(string $url, string $formSelector): static
    {
        $script = <<<CDATA
var formData = $("{$formSelector}").find("input, select").serializeArray();
$.each(formData, function(i, obj){
    data[obj.name] = obj.value;
});
CDATA;

        return $this->minifiedAjax($url, $script);
    }

    /**
     * Minify ajax url generated when using get request
     * by deleting unnecessary url params.
     *
     * @param  string  $url
     * @param  string|null  $script
     * @param  array  $data
     * @param  array  $ajaxParameters
     * @return $this
     */
    public function minifiedAjax(
        string $url = '',
        string $script = null,
        array $data = [],
        array $ajaxParameters = []
    ): static {
        $this->ajax = [];
        $appendData = $this->makeDataScript($data);

        $this->ajax['url'] = empty($url) ? url()->full() : $url;
        $this->ajax['type'] = 'GET';
        if (! isset($this->attributes['serverSide']) || $this->attributes['serverSide']) {
            $this->ajax['data'] = 'function(data) {
            for (var i = 0, len = data.columns.length; i < len; i++) {
                if (!data.columns[i].search.value) delete data.columns[i].search;
                if (data.columns[i].searchable === true) delete data.columns[i].searchable;
                if (data.columns[i].orderable === true) delete data.columns[i].orderable;
                if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
            }
            delete data.search.regex;';
        } else {
            $this->ajax['data'] = 'function(data){';
        }

        if ($appendData) {
            $this->ajax['data'] .= $appendData;
        }

        if ($script) {
            $this->ajax['data'] .= $script;
        }

        $this->ajax['data'] .= '}';

        $this->ajax = array_merge($this->ajax, $ajaxParameters);

        return $this;
    }

    /**
     * Make a data script to be appended on ajax request of dataTables.
     *
     * @param  array  $data
     * @return string
     */
    protected function makeDataScript(array $data): string
    {
        $script = '';
        foreach ($data as $key => $value) {
            $dataValue = $this->isCallbackFunction($value, $key) ? $value : "'{$value}'";
            $script .= PHP_EOL."data.{$key} = {$dataValue};";
        }

        return $script;
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

        $callbacks = $this->config->get('datatables-html.callback', ['$', '$.', 'function']);

        if (! is_array($callbacks)) {
            return false;
        }

        return Str::startsWith(trim($value), $callbacks) || Str::contains($key, 'editor');
    }
}
