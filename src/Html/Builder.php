<?php

namespace Yajra\DataTables\Html;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Traits\Macroable;
use Yajra\DataTables\Utilities\Helper;

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
     * The default type to use for the DataTables javascript.
     */
    protected static string $jsType = 'text/javascript';

    /**
     * @var Collection<int, \Yajra\DataTables\Html\Column>
     */
    public Collection $collection;

    /**
     * @var array<string, string|null>
     */
    protected array $tableAttributes = [];

    /**
     * @var string
     */
    protected string $template = '';

    /**
     * @var array
     */
    protected array $attributes = [];

    /**
     * @var string|array
     */
    protected string|array $ajax = '';

    /**
     * @param  Repository  $config
     * @param  Factory  $view
     * @param  HtmlBuilder  $html
     */
    public function __construct(public Repository $config, public Factory $view, public HtmlBuilder $html)
    {
        /** @var array $defaults */
        $defaults = $this->config->get('datatables-html.table', []);

        $this->collection = new Collection;
        $this->tableAttributes = $defaults;
        $this->attributes = [
            'serverSide' => true,
            'processing' => true,
        ];
    }

    /**
     * Set the default type to module for the DataTables javascript.
     */
    public static function useVite(): void
    {
        static::$jsType = 'module';
    }

    /**
     * Set the default type to text/javascript for the DataTables javascript.
     */
    public static function useWebpack(): void
    {
        static::$jsType = 'text/javascript';
    }

    /**
     * Generate DataTable javascript.
     *
     * @param  string|null  $script
     * @param  array  $attributes
     * @return \Illuminate\Support\HtmlString
     */
    public function scripts(string $script = null, array $attributes = ['type' => 'text/javascript']): HtmlString
    {
        $script = $script ?: $this->generateScripts();
        $attributes = $this->html->attributes(
            array_merge($attributes, ['type' => static::$jsType])
        );

        return new HtmlString("<script{$attributes}>$script</script>");
    }

    /**
     * Get generated raw scripts.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function generateScripts(): HtmlString
    {
        $parameters = $this->generateJson();

        return new HtmlString(
            trim(sprintf($this->template(), $this->getTableAttribute('id'), $parameters))
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
     * Generate DataTables js parameters.
     *
     * @param  array  $attributes
     * @return string
     */
    public function parameterize(array $attributes = []): string
    {
        $parameters = (new Parameters($attributes))->toArray();

        return Helper::toJsonScript($parameters);
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
     * Get javascript template to use.
     *
     * @return string
     */
    protected function template(): string
    {
        /** @var view-string $configTemplate */
        $configTemplate = $this->config->get('datatables-html.script', 'datatables::script');

        $template = $this->template ?: $configTemplate;

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

        $tableHtml = '<table'.$htmlAttr.'>';
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
     * Generate scripts that set the dataTables options into a variable.
     *
     * @return $this
     */
    public function asOptions(): static
    {
        return $this->setTemplate('datatables::options');
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
     * Wrap dataTable scripts with a function.
     *
     * @return $this
     */
    public function asFunction(): static
    {
        return $this->setTemplate('datatables::function');
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function getAttribute(string $key, mixed $default = ''): mixed
    {
        return $this->attributes[$key] ?? $default;
    }

    /**
     * @param  string|null  $key
     * @return array|string
     */
    public function getAjax(string $key = null): array|string
    {
        if (! is_null($key)) {
            return $this->ajax[$key] ?? '';
        }

        return $this->ajax;
    }
}
