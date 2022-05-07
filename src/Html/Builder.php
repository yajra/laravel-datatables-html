<?php

namespace Yajra\DataTables\Html;

use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Traits\Macroable;

class Builder
{
    use Macroable;
    use HasOptions;
    use HasTable;
    use HasEditor;
    use Columns\Index;
    use Columns\Action;
    use Columns\Checkbox;

    // Select plugin constants.
    const SELECT_STYLE_API = 'api';
    const SELECT_STYLE_SINGLE = 'single';
    const SELECT_STYLE_MULTI = 'multi';
    const SELECT_STYLE_OS = 'os';
    const SELECT_STYLE_MULTI_SHIFT = 'multi+shift';
    const SELECT_ITEMS_ROW = 'row';
    const SELECT_ITEMS_COLUMN = 'column';
    const SELECT_ITEMS_CELL = 'cell';

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
     * @var array<string, string|null>
     */
    protected $tableAttributes = [];

    /**
     * @var string
     */
    protected string $template = '';

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @param  Repository  $config
     * @param  Factory  $view
     * @param  HtmlBuilder  $html
     */
    public function __construct(Repository $config, Factory $view, HtmlBuilder $html)
    {
        $this->config = $config;
        $this->view = $view;
        $this->html = $html;
        $this->collection = new Collection;
        $this->tableAttributes = $this->config->get('datatables-html.table', []);
        $this->attributes = [
            'serverSide' => true,
            'processing' => true,
        ];
    }

    /**
     * Generate DataTable javascript.
     *
     * @param  null  $script
     * @param  array  $attributes
     * @return \Illuminate\Support\HtmlString
     * @throws \Exception
     */
    public function scripts($script = null, array $attributes = ['type' => 'text/javascript']): HtmlString
    {
        $script = $script ?: $this->generateScripts();
        $attributes = $this->html->attributes($attributes);

        return new HtmlString("<script{$attributes}>{$script}</script>\n");
    }

    /**
     * Get generated raw scripts.
     *
     * @return \Illuminate\Support\HtmlString
     * @throws \Exception
     */
    public function generateScripts(): HtmlString
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
    public function generateJson(): string
    {
        return $this->parameterize($this->getOptions());
    }

    /**
     * Get DataTable options array.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return array_merge(
            $this->attributes, [
                'ajax' => $this->ajax,
                'columns' => $this->collection->map(function (Column $column) {
                    $column = $column->toArray();
                    unset($column['attributes']);

                    return $column;
                })->toArray(),
            ]
        );
    }

    /**
     * Generate DataTables js parameters.
     *
     * @param  array  $attributes
     * @return string
     */
    public function parameterize(array $attributes = []): string
    {
        $parameters = (new Parameters($attributes))->toArray();

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

        $json = json_encode($new);

        return str_replace($replacements, $values, $json);
    }

    /**
     * Get javascript template to use.
     *
     * @return string
     */
    protected function template(): string
    {
        $template = $this->template ?: $this->config->get('datatables-html.script', 'datatables::script');

        return $this->view->make($template, ['editors' => $this->editors])->render();
    }

    /**
     * Generate DataTable's table html.
     *
     * @param  array  $attributes
     * @param  bool  $drawFooter
     * @param  bool  $drawSearch
     * @return \Illuminate\Support\HtmlString
     */
    public function table(array $attributes = [], bool $drawFooter = false, bool $drawSearch = false): HtmlString
    {
        $this->setTableAttributes($attributes);

        $th = $this->compileTableHeaders();
        $htmlAttr = $this->html->attributes($this->tableAttributes);

        $tableHtml = '<table '.$htmlAttr.'>';
        $searchHtml = $drawSearch ? '<tr class="search-filter">'.implode('',
                $this->compileTableSearchHeaders()).'</tr>' : '';
        $tableHtml .= '<thead><tr>'.implode('', $th).'</tr>'.$searchHtml.'</thead>';
        if ($drawFooter) {
            $tf = $this->compileTableFooter();
            $tableHtml .= '<tfoot><tr>'.implode('', $tf).'</tr></tfoot>';
        }
        $tableHtml .= '</table>';

        return new HtmlString($tableHtml);
    }

    /**
     * Configure DataTable's parameters.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function parameters(array $attributes = []): static
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    /**
     * Set custom javascript template.
     *
     * @param  string  $template
     * @return $this
     */
    public function setTemplate(string $template): static
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Generate scripts that sets the dataTables options into a variable.
     *
     * @return $this
     */
    public function asOptions(): static
    {
        return $this->setTemplate('datatables::options');
    }

    /**
     * Wrap dataTable scripts with a function.
     *
     * @return $this
     */
    public function asFunction(): static
    {
        return $this->setTemplate('datatables::function');
    }
}
