<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Collective\Html\HtmlBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Config\Repository;

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
     * Dynamically detects which DataTable to initialize for backend processing and responds.
     *
     * @var string|null
     */
    protected $smartDataTable = null;

    /**
     * @param Repository  $config
     * @param Factory     $view
     * @param HtmlBuilder $html
     */
    public function __construct(Repository $config, Factory $view, HtmlBuilder $html)
    {
        $this->config          = $config;
        $this->view            = $view;
        $this->html            = $html;
        $this->collection      = new Collection;
        $this->tableAttributes = $this->config->get('datatables-html.table', []);
    }

    public function setSmartDataTable($className)
    {
    	$this->smartDataTable = $className;

    	return $this;
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
            sprintf($this->template(), $this->getTableAttribute('id'), $parameters)
        );
    }

    public function getAjaxUrl()
    {
    	return is_array($this->ajax) ? $this->ajax['url'] : $this->ajax;
    }

    public function getQueryString()
    {
    	if ($this->hasCustomTableId()) {
	    	$separator = str_contains($this->getAjaxUrl(), '?') ? '&' : '?';

	    	$http_build_query = [
	    	    'tableId' => $this->tableAttributes['id'],
	    	];

	    	if (!is_null($this->smartDataTable)) {
				$http_build_query['smartDataTable'] = $this->smartDataTable;	    		
	    	}

	    	return $separator.http_build_query($http_build_query);
    	}

    	return '';
    }

    public function buildAjax()
    {
    	$queryString = $this->getQueryString();

    	if (is_array($this->ajax)) {
    	    $this->ajax['url'] = $this->ajax['url'].$queryString;
    	} else {
    	    $this->ajax = $this->ajax.$queryString;
    	}

    	return $this->ajax;
    }

    /**
     * Get generated json configuration.
     *
     * @return string
     */
    public function generateJson()
    {
    	$this->buildAjax();

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


        foreach (array_dot($parameters) as $key => $value) {
            if ($this->isCallbackFunction($value, $key) || $this->isJavascriptFunction($value, $key)) {
                $values[] = trim($value);
                array_set($parameters, $key, '%' . $key . '%');
                $replacements[] = '"%' . $key . '%"';
            }
        }

        foreach ($parameters as $key => $value) {
            array_set($new, $key, $value);
        }

        $json = json_encode($new);

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
        return Str::startsWith(trim($value), 'function') || Str::contains($key, 'editor');
    }

    /**
     * Check if given key & value is a valid callback js function.
     *
     * @param string $value
     * @param string $key
     * @return bool
     */
    protected function isJavascriptFunction($value, $key)
    {
        return Str::startsWith(trim($value), ['$', '$.', 'function']);
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
     * Retrieves HTML table attribute value.
     *
     * @param string $attribute
     * @return mixed
     * @throws \Exception
     */
    public function getTableAttribute($attribute)
    {
        if (! array_key_exists($attribute, $this->tableAttributes)) {
            throw new \Exception("Table attribute '{$attribute}' does not exist.");
        }

        return $this->tableAttributes[$attribute];
    }

    /**
     * Get table computed table attributes.
     *
     * @return array
     */
    public function getTableAttributes()
    {
        return $this->tableAttributes;
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
            $this->tableAttributes[$attribute] = $value;
        }

        return $this;
    }

    /**
     * Sets HTML table "id" attribute.
     *
     * @param string $id
     * @return $this
     */
    public function setTableId($id)
    {
        return $this->setTableAttribute('id', $id);
    }

    /**
     * Determine if the datatable has a custom id.
     *  
     * @return boolean
     */
    private function hasCustomTableId()
    {
        return $this->tableAttributes['id'] != 'dataTableBuilder';
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
            return $this->setTableAttributes($attribute);
        }

        $this->tableAttributes[$attribute] = $value;

        return $this;
    }

    /**
     * Add class names to the "class" attribute of HTML table.
     *
     * @param string|array $class
     * @return $this
     */
    public function addTableClass($class)
    {
        $class        = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = Arr::get(array_change_key_case($this->tableAttributes), 'class');

        $classes = preg_split('#\s+#', $currentClass . ' ' . $class, null, PREG_SPLIT_NO_EMPTY);
        $class   = implode(' ', array_unique($classes));

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
        $class        = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = Arr::get(array_change_key_case($this->tableAttributes), 'class');

        $classes = array_diff(
            preg_split('#\s+#', $currentClass, null, PREG_SPLIT_NO_EMPTY),
            preg_split('#\s+#', $class, null, PREG_SPLIT_NO_EMPTY)
        );
        $class   = implode(' ', array_unique($classes));

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
     * Add a Column object at the beginning of collection.
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
            if (! is_a($value, Column::class)) {
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
        if (! isset($attributes['title'])) {
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
        Arr::set($attributes, 'type', 'POST');
        Arr::set($attributes, 'headers.X-HTTP-Method-Override', 'GET');

        return $this->ajax($attributes);
    }

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
     * Generate DataTable's table html.
     *
     * @param array $attributes
     * @param bool  $drawFooter
     * @param bool  $drawSearch
     * @return \Illuminate\Support\HtmlString
     */
    public function table(array $attributes = [], $drawFooter = false, $drawSearch = false)
    {
        $this->setTableAttributes($attributes);

        $th       = $this->compileTableHeaders();
        $htmlAttr = $this->html->attributes($this->tableAttributes);

        $tableHtml  = '<table ' . $htmlAttr . '>';
        $searchHtml = $drawSearch ? '<tr class="search-filter">' . implode('',
                $this->compileTableSearchHeaders()) . '</tr>' : '';
        $tableHtml .= '<thead><tr>' . implode('', $th) . '</tr>' . $searchHtml . '</thead>';
        if ($drawFooter) {
            $tf        = $this->compileTableFooter();
            $tableHtml .= '<tfoot><tr>' . implode('', $tf) . '</tr></tfoot>';
        }
        $tableHtml .= '</table>';

        return new HtmlString($tableHtml);
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
     * Compile table search headers.
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

        return $this;
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
}
