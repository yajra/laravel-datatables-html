<?php

namespace Yajra\DataTables\Html;

use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

class Builder
{
    use Macroable;

    /**
     * @var Collection
     */
    public $collection;

    /**
     * @var Repository
     */
    public $config;

    /**
     * @var Factory
     */
    public $view;

    /**
     * @var HtmlBuilder
     */
    public $html;

    /**
     * @var string|array
     */
    protected $ajax = '';

    /**
     * @var array
     */
    protected $tableAttributes = [];

    /**
     * @var string
     */
    protected $template = '';

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Lists of valid DataTables Callbacks.
     *
     * @link https://datatables.net/reference/option/.
     * @var array
     */
    protected $validCallbacks = [
        'createdRow',
        'drawCallback',
        'footerCallback',
        'formatNumber',
        'headerCallback',
        'infoCallback',
        'initComplete',
        'preDrawCallback',
        'rowCallback',
        'stateLoadCallback',
        'stateLoaded',
        'stateLoadParams',
        'stateSaveCallback',
        'stateSaveParams',
        'fnServerParams',
    ];

    /**
     * @param Repository  $config
     * @param Factory     $view
     * @param HtmlBuilder $html
     */
    public function __construct(Repository $config, Factory $view, HtmlBuilder $html)
    {
        $this->config     = $config;
        $this->view       = $view;
        $this->html       = $html;
        $this->collection = new Collection;
    }

    /**
     * Generate DataTable javascript.
     *
     * @param  null  $script
     * @param  array $attributes
     * @return \Illuminate\Support\HtmlString
     */
    public function scripts($script = null, array $attributes = ['type' => 'text/javascript'])
    {
        $script     = $script ?: $this->generateScripts();
        $attributes = $this->html->attributes($attributes);

        return new HtmlString("<script{$attributes}>{$script}</script>\n");
    }

    /**
     * Get generated raw scripts.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function generateScripts()
    {
        $parameters = $this->generateJson();

        return new HtmlString(
            sprintf($this->template(), $this->getTableAttributes()['id'], $parameters)
        );
    }

    /**
     * Get generated json configuration.
     *
     * @return string
     */
    public function generateJson()
    {
        $args = array_merge(
            $this->attributes, [
                'ajax'    => $this->ajax,
                'columns' => $this->collection->map(function (Column $column) {
                    $column = $column->toArray();
                    unset($column['attributes']);

                    return $column;
                })->toArray(),
            ]
        );

        return $this->parameterize($args);
    }

    /**
     * Generate DataTables js parameters.
     *
     * @param  array $attributes
     * @return string
     */
    public function parameterize($attributes = [])
    {
        $parameters = (new Parameters($attributes))->toArray();

        $values       = [];
        $replacements = [];
        foreach ($parameters as $key => &$value) {
            if (!is_array($value)) {
                if (strpos($value, '$.') === 0) {
                    // Store function string.
                    $values[] = $value;
                    // Replace function string in $foo with a 'unique' special key.
                    $value = '%' . $key . '%';
                    // Later on, we'll look for the value, and replace it.
                    $replacements[] = '"' . $value . '"';
                }
            }
        }

        list($ajaxDataFunction, $parameters) = $this->encodeAjaxDataFunction($parameters);
        list($columnFunctions, $parameters) = $this->encodeColumnFunctions($parameters);
        list($callbackFunctions, $parameters) = $this->encodeCallbackFunctions($parameters);

        $json = json_encode($parameters);

        $json = str_replace($replacements, $values, $json);

        $json = $this->decodeAjaxDataFunction($ajaxDataFunction, $json);
        $json = $this->decodeColumnFunctions($columnFunctions, $json);
        $json = $this->decodeCallbackFunctions($callbackFunctions, $json);

        return $json;
    }

    /**
     * Get table computed table attributes.
     *
     * @return array
     */
    public function getTableAttributes()
    {
        $default = $this->config->get('datatables-html.table', ['class' => 'table', 'id' => 'dataTableBuilder']);

        return array_merge($default, $this->tableAttributes);
    }

    /**
     * Sets multiple HTML table attributes at once.
     *
     * @param array $attributes
     * @return $this
     */
    public function setTableAttributes(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->setTableAttribute($attribute, $value);
        }

        return $this;
    }

    /**
     * Sets HTML table attribute(s).
     *
     * @param string|array $attribute
     * @param mixed        $value
     * @return $this
     */
    public function setTableAttribute($attribute, $value = null)
    {
        if (is_array($attribute)) {
            $this->setTableAttributes($attribute);
        } else {
            $this->tableAttributes[$attribute] = $value;
        }

        return $this;
    }

    /**
     * Retrieves HTML table attribute value.
     *
     * @param string $attribute
     * @return mixed
     * @throws \Exception
     */
    public function getTableAttribute($attribute)
    {
        if (!array_key_exists($attribute, $this->tableAttributes)) {
            throw new \Exception("Table attribute '{$attribute}' does not exist.");
        }

        return $this->tableAttributes[$attribute];
    }

    /**
     * Add class names to the "class" attribute of HTML table.
     *
     * @param string|array $class
     * @return $this
     */
    public function addTableClass($class)
    {
        $class = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = Arr::get(array_change_key_case($this->tableAttributes), 'class');

        $classes = preg_split('#\s+#', $currentClass.' '.$class, null, PREG_SPLIT_NO_EMPTY);
        $class = implode(' ', array_unique($classes));

        return $this->setTableAttribute('class', $class);
    }

    /**
     * Remove class names from the "class" attribute of HTML table.
     *
     * @param string|array $class
     * @return $this
     */
    public function removeTableClass($class)
    {
        $class = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = Arr::get(array_change_key_case($this->tableAttributes), 'class');

        $classes = array_diff(
            preg_split('#\s+#', $currentClass, null, PREG_SPLIT_NO_EMPTY),
            preg_split('#\s+#', $class, null, PREG_SPLIT_NO_EMPTY)
        );
        $class = implode(' ', array_unique($classes));

        return $this->setTableAttribute('class', $class);
    }

    /**
     * Add a column in collection usingsl attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function addColumn(array $attributes)
    {
        $this->collection->push(new Column($attributes));

        return $this;
    }

    /**
     * Add a Column object at the beginning of collection
     *
     * @param \Yajra\DataTables\Html\Column $column
     * @return $this
     */
    public function addBefore(Column $column)
    {
        $this->collection->prepend($column);

        return $this;
    }

    /**
     * Add a column at the beginning of collection using attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function addColumnBefore(array $attributes)
    {
        $this->collection->prepend(new Column($attributes));

        return $this;
    }

    /**
     * Add a Column object in collection.
     *
     * @param \Yajra\DataTables\Html\Column $column
     * @return $this
     */
    public function add(Column $column)
    {
        $this->collection->push($column);

        return $this;
    }

    /**
     * Set datatables columns from array definition.
     *
     * @param array $columns
     * @return $this
     */
    public function columns(array $columns)
    {
        $this->collection = new Collection;

        foreach ($columns as $key => $value) {
            if (!is_a($value, Column::class)) {
                if (is_array($value)) {
                    $attributes = array_merge(['name' => $key, 'data' => $key], $this->setTitle($key, $value));
                } else {
                    $attributes = [
                        'name'  => $value,
                        'data'  => $value,
                        'title' => $this->getQualifiedTitle($value),
                    ];
                }

                $this->collection->push(new Column($attributes));
            } else {
                $this->collection->push($value);
            }
        }

        return $this;
    }

    /**
     * Set title attribute of an array if not set.
     *
     * @param string $title
     * @param array  $attributes
     * @return array
     */
    public function setTitle($title, array $attributes)
    {
        if (!isset($attributes['title'])) {
            $attributes['title'] = $this->getQualifiedTitle($title);
        }

        return $attributes;
    }

    /**
     * Convert string into a readable title.
     *
     * @param string $title
     * @return string
     */
    public function getQualifiedTitle($title)
    {
        return Str::title(str_replace(['.', '_'], ' ', Str::snake($title)));
    }

    /**
     * Add a checkbox column.
     *
     * @param  array $attributes
     * @return $this
     */
    public function addCheckbox(array $attributes = [])
    {
        $attributes = array_merge([
            'defaultContent' => '<input type="checkbox" ' . $this->html->attributes($attributes) . '/>',
            'title'          => '<input type="checkbox" ' . $this->html->attributes($attributes + ['id' => 'dataTablesCheckbox']) . '/>',
            'data'           => 'checkbox',
            'name'           => 'checkbox',
            'orderable'      => false,
            'searchable'     => false,
            'exportable'     => false,
            'printable'      => true,
            'width'          => '10px',
        ], $attributes);
        $this->collection->push(new Column($attributes));

        return $this;
    }

    /**
     * Add a action column.
     *
     * @param  array $attributes
     * @return $this
     */
    public function addAction(array $attributes = [])
    {
        $attributes = array_merge([
            'defaultContent' => '',
            'data'           => 'action',
            'name'           => 'action',
            'title'          => 'Action',
            'render'         => null,
            'orderable'      => false,
            'searchable'     => false,
            'exportable'     => false,
            'printable'      => true,
            'footer'         => '',
        ], $attributes);
        $this->collection->push(new Column($attributes));

        return $this;
    }

    /**
     * Add a index column.
     *
     * @param  array $attributes
     * @return $this
     */
    public function addIndex(array $attributes = [])
    {
        $indexColumn = $this->config->get('datatables.index_column', 'DT_Row_Index');
        $attributes  = array_merge([
            'defaultContent' => '',
            'data'           => $indexColumn,
            'name'           => $indexColumn,
            'title'          => '',
            'render'         => null,
            'orderable'      => false,
            'searchable'     => false,
            'exportable'     => false,
            'printable'      => true,
            'footer'         => '',
        ], $attributes);
        $this->collection->push(new Column($attributes));

        return $this;
    }

    /**
     * Setup ajax parameter for datatables pipeline plugin
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
     * Setup ajax parameter
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
     * Generate DataTable's table html.
     *
     * @param array $attributes
     * @param bool  $drawFooter
     * @param bool  $drawSearch
     * @return \Illuminate\Support\HtmlString
     */
    public function table(array $attributes = [], $drawFooter = false, $drawSearch = false)
    {
        $this->tableAttributes = array_merge($this->getTableAttributes(), $attributes);

        $th       = $this->compileTableHeaders();
        $htmlAttr = $this->html->attributes($this->tableAttributes);

        $tableHtml  = '<table ' . $htmlAttr . '>';
        $searchHtml = $drawSearch ? '<tr class="search-filter">' . implode('',
                $this->compileTableSearchHeaders()) . '</tr>' : '';
        $tableHtml  .= '<thead><tr>' . implode('', $th) . '</tr>' . $searchHtml . '</thead>';
        if ($drawFooter) {
            $tf        = $this->compileTableFooter();
            $tableHtml .= '<tfoot><tr>' . implode('', $tf) . '</tr></tfoot>';
        }
        $tableHtml .= '</table>';

        return new HtmlString($tableHtml);
    }

    /**
     * Configure DataTable's parameters.
     *
     * @param  array $attributes
     * @return $this
     */
    public function parameters(array $attributes = [])
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    /**
     * Set custom javascript template.
     *
     * @param string $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get collection of columns.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getColumns()
    {
        return $this->collection;
    }

    /**
     * Remove column by name.
     *
     * @param array $names
     * @return $this
     */
    public function removeColumn(...$names)
    {
        foreach ($names as $name) {
            $this->collection = $this->collection->filter(function (Column $column) use ($name) {
                return $column->name !== $name;
            })->flatten();
        }

        return $this;
    }

    /**
     * Minify ajax url generated when using get request
     * by deleting unnecessary url params.
     *
     * @param string $url
     * @param string $script
     * @param array  $data
     * @return $this
     */
    public function minifiedAjax($url = '', $script = null, $data = [])
    {
        $this->ajax = [];
        $appendData = $this->makeDataScript($data);

        $this->ajax['url']  = $url;
        $this->ajax['type'] = 'GET';
        if (isset($this->attributes['serverSide']) ? $this->attributes['serverSide'] : true) {
            $this->ajax['data'] = "function(data) {
            for (var i = 0, len = data.columns.length; i < len; i++) {
                if (!data.columns[i].search.value) delete data.columns[i].search;
                if (data.columns[i].searchable === true) delete data.columns[i].searchable;
                if (data.columns[i].orderable === true) delete data.columns[i].orderable;
                if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
            }
            delete data.search.regex;";
        } else {
            $this->ajax['data'] = "function(data){";
        }

        if ($appendData) {
            $this->ajax['data'] .= $appendData;
        }

        if ($script) {
            $this->ajax['data'] .= $script;
        }

        $this->ajax['data'] .= "}";

        return $this;
    }

    /**
     * Encode ajax data function param.
     *
     * @param array $parameters
     * @return mixed
     */
    protected function encodeAjaxDataFunction($parameters)
    {
        $ajaxData = '';
        if (isset($parameters['ajax']['data'])) {
            $ajaxData                   = $parameters['ajax']['data'];
            $parameters['ajax']['data'] = "#ajax_data#";
        }

        return [$ajaxData, $parameters];
    }

    /**
     * Encode columns render function.
     *
     * @param array $parameters
     * @return array
     */
    protected function encodeColumnFunctions(array $parameters)
    {
        $columnFunctions = [];
        foreach ($parameters['columns'] as $i => $column) {
            unset($parameters['columns'][$i]['exportable']);
            unset($parameters['columns'][$i]['printable']);
            unset($parameters['columns'][$i]['footer']);

            if (isset($column['render'])) {
                $columnFunctions[$i]                 = $column['render'];
                $parameters['columns'][$i]['render'] = "#column_function.{$i}#";
            }
        }

        return [$columnFunctions, $parameters];
    }

    /**
     * Encode DataTables callbacks function.
     *
     * @param array $parameters
     * @return array
     */
    protected function encodeCallbackFunctions(array $parameters)
    {
        $callbackFunctions = [];
        foreach ($parameters as $key => $callback) {
            if (in_array($key, $this->validCallbacks)) {
                $callbackFunctions[$key] = $this->compileCallback($callback);
                $parameters[$key]        = "#callback_function.{$key}#";
            }
        }

        return [$callbackFunctions, $parameters];
    }

    /**
     * Decode ajax data method.
     *
     * @param string $function
     * @param string $json
     * @return string
     */
    protected function decodeAjaxDataFunction($function, $json)
    {
        return str_replace("\"#ajax_data#\"", $function, $json);
    }

    /**
     * Decode columns render functions.
     *
     * @param array  $columnFunctions
     * @param string $json
     * @return string
     */
    protected function decodeColumnFunctions(array $columnFunctions, $json)
    {
        foreach ($columnFunctions as $i => $function) {
            $json = str_replace("\"#column_function.{$i}#\"", $function, $json);
        }

        return $json;
    }

    /**
     * Decode DataTables callbacks function.
     *
     * @param array  $callbackFunctions
     * @param string $json
     * @return string
     */
    protected function decodeCallbackFunctions(array $callbackFunctions, $json)
    {
        foreach ($callbackFunctions as $i => $function) {
            $json = str_replace("\"#callback_function.{$i}#\"", $function, $json);
        }

        return $json;
    }

    /**
     * Get javascript template to use.
     *
     * @return string
     */
    protected function template()
    {
        return $this->view->make(
            $this->template ?: $this->config->get('datatables.script_template', 'datatables::script')
        )->render();
    }

    /**
     * Make a data script to be appended on ajax request of dataTables.
     *
     * @param array $data
     * @return string
     */
    protected function makeDataScript(array $data)
    {
        $script = '';
        foreach ($data as $key => $value) {
            $script .= PHP_EOL . "data.{$key} = '{$value}';";
        }

        return $script;
    }

    /**
     * Compile DataTable callback value.
     *
     * @param mixed $callback
     * @return mixed|string
     */
    private function compileCallback($callback)
    {
        if (is_callable($callback)) {
            return value($callback);
        } elseif ($this->view->exists($callback)) {
            return $this->view->make($callback)->render();
        }

        return $callback;
    }

    /**
     * Compile table headers and to support responsive extension.
     *
     * @return array
     */
    private function compileTableHeaders()
    {
        $th = [];
        foreach ($this->collection->toArray() as $row) {
            $thAttr = $this->html->attributes(array_merge(
                array_only($row, ['class', 'id', 'width', 'style', 'data-class', 'data-hide']),
                $row['attributes']
            ));
            $th[]   = '<th ' . $thAttr . '>' . $row['title'] . '</th>';
        }

        return $th;
    }

    /**
     * Compile table search headers
     *
     * @return array
     */
    private function compileTableSearchHeaders()
    {
        $search = [];
        foreach ($this->collection->all() as $key => $row) {
            $search[] = $row['searchable'] ? '<th>' . (isset($row->search) ? $row->search : '') . '</th>' : '<th></th>';
        }

        return $search;
    }

    /**
     * Compile table footer contents.
     *
     * @return array
     */
    private function compileTableFooter()
    {
        $footer = [];
        foreach ($this->collection->all() as $row) {
            if (is_array($row->footer)) {
                $footerAttr = $this->html->attributes(array_only($row->footer,
                    ['class', 'id', 'width', 'style', 'data-class', 'data-hide']));
                $title      = isset($row->footer['title']) ? $row->footer['title'] : '';
                $footer[]   = '<th ' . $footerAttr . '>' . $title . '</th>';
            } else {
                $footer[] = '<th>' . $row->footer . '</th>';
            }
        }

        return $footer;
    }
}
