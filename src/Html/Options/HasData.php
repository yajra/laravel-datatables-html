<?php

namespace Yajra\DataTables\Html\Options;

/**
 * DataTables - Data option builder.
 *
 * @see https://datatables.net/reference/option/
 */
trait HasData
{
    /**
     * @var string|array
     */
    protected $ajax = '';

    /**
     * Setup ajax parameter.
     *
     * @param  string|array $attributes
     * @return $this
     */
    public function ajax($attributes = '')
    {
        $this->ajax = $attributes;

        return $this;
    }

    /**
     * Setup "ajax" parameter with POST method.
     *
     * @param  string|array $attributes
     * @return $this
     */
    public function postAjax($attributes = '')
    {
        if (! is_array($attributes)) {
            $attributes = ['url' => (string) $attributes];
        }

        unset($attributes['method']);
        array_set($attributes, 'type', 'POST');
        array_set($attributes, 'headers.X-HTTP-Method-Override', 'GET');

        return $this->ajax($attributes);
    }

    /**
     * Setup ajax parameter for datatables pipeline plugin.
     *
     * @param  string $url
     * @param  string $pages
     * @return $this
     */
    public function pipeline($url, $pages)
    {
        $this->ajax = "$.fn.dataTable.pipeline({ url: '{$url}', pages: {$pages} })";

        return $this;
    }

    /**
     * Minify ajax url generated when using get request
     * by deleting unnecessary url params.
     *
     * @param string $url
     * @param string $script
     * @param array $data
     * @param array $ajaxParameters
     * @return $this
     */
    public function minifiedAjax($url = '', $script = null, $data = [], $ajaxParameters = [])
    {
        $this->ajax = [];
        $appendData = $this->makeDataScript($data);

        $this->ajax['url'] = $url;
        $this->ajax['type'] = 'GET';
        if (isset($this->attributes['serverSide']) ? $this->attributes['serverSide'] : true) {
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
     * Get ajax url.
     *
     * @return array|mixed|string
     */
    public function getAjaxUrl()
    {
        if (is_array($this->ajax)) {
            return $this->ajax['url'] ?: url()->current();
        }

        return $this->ajax ?: url()->current();
    }

    /**
     * Set ajax url with data added from form.
     *
     * @param string $url
     * @param string $formSelector
     * @return $this
     */
    public function ajaxWithForm($url, $formSelector)
    {
        $script = <<<CDATA
var formData = $("{$formSelector}").find("input, select").serializeArray();
$.each(formData, function(i, obj){
    data[obj.name] = obj.value;
});
CDATA;

        return $this->minifiedAjax($url, $script);
    }
}
