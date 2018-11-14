<?php

namespace Yajra\DataTables\Html;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Collective\Html\HtmlBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Config\Repository;
use Yajra\DataTables\Html\Options\HasOptions;

class Builder
{
    use Macroable;
    use HasOptions;

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
     * Collection of Editors.
     *
     * @var null|Editor
     */
    protected $editors = [];

    /**
     * @param Repository $config
     * @param Factory $view
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

    /**
     * Generate DataTable javascript.
     *
     * @param  null $script
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

        foreach (array_dot($parameters) as $key => $value) {
            if ($this->isCallbackFunction($value, $key)) {
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
        if (empty($value)) {
            return false;
        }

        return Str::startsWith(trim($value), $this->config->get('datatables-html.callback', ['$', '$.', 'function']))
            || Str::contains($key, 'editor');
    }

    /**
     * Get javascript template to use.
     *
     * @return string
     */
    protected function template()
    {
        $template = $this->template ?: $this->config->get('datatables-html.script', 'datatables::script');

        return $this->view->make($template, ['editors' => $this->editors])->render();
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
     * Sets HTML table attribute(s).
     *
     * @param string|array $attribute
     * @param mixed $value
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
        $class = implode(' ', array_unique($classes));

        return $this->setTableAttribute('class', $class);
    }

    /**
     * Set title attribute of an array if not set.
     *
     * @param string $title
     * @param array $attributes
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
     * @param  bool|int $position true to prepend, false to append or a zero-based index for positioning
     * @return $this
     */
    public function addCheckbox(array $attributes = [], $position = false)
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
        $column = new Column($attributes);

        if ($position === true) {
            $this->collection->prepend($column);
        } elseif ($position === false || $position >= $this->collection->count()) {
            $this->collection->push($column);
        } else {
            $this->collection->splice($position, 0, [$column]);
        }

        return $this;
    }

    /**
     * Add a action column.
     *
     * @param  array $attributes
     * @param  bool  $prepend
     * @return $this
     */
    public function addAction(array $attributes = [], $prepend = false)
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

        if ($prepend) {
            $this->collection->prepend(new Column($attributes));
        } else {
            $this->collection->push(new Column($attributes));
        }

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
        $indexColumn = $this->config->get('datatables.index_column', 'DT_RowIndex');
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
     * Generate DataTable's table html.
     *
     * @param array $attributes
     * @param bool $drawFooter
     * @param bool $drawSearch
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
            $tf = $this->compileTableFooter();
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
            $th[] = '<th ' . $thAttr . '>' . $row['title'] . '</th>';
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
                $title    = isset($row->footer['title']) ? $row->footer['title'] : '';
                $footer[] = '<th ' . $footerAttr . '>' . $title . '</th>';
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
     * Attach multiple editors to builder.
     *
     * @param mixed ...$editors
     * @return $this
     * @see https://editor.datatables.net/
     */
    public function editors(...$editors)
    {
        foreach ($editors as $editor) {
            $this->editor($editor);
        }

        return $this;
    }

    /**
     * Integrate with DataTables Editor.
     *
     * @param array|Editor $fields
     * @return $this
     * @see https://editor.datatables.net/
     */
    public function editor($fields)
    {
        $this->setTemplate($this->config->get('datatables-html.editor', 'datatables::editor'));

        $editor = $this->newEditor($fields);

        $this->editors[] = $editor;

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
     * @param array|Editor $fields
     * @throws \Exception
     */
    protected function newEditor($fields)
    {
        if ($fields instanceof Editor) {
            $editor = $fields;
        } else {
            $editor = new Editor;
            $editor->fields($fields);
        }

        if (! $editor->table) {
            $editor->table($this->getTableAttribute('id'));
        }

        if (! $editor->ajax) {
            $editor->ajax($this->getAjaxUrl());
        }

        return $editor;
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
     * Select plugin integration/option.
     *
     * @param bool|array $options
     * @return $this
     * @see https://www.datatables.net/extensions/select/
     */
    public function select($options = true)
    {
        $this->attributes['select'] = $options;

        return $this;
    }
}
