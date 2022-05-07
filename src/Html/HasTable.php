<?php

namespace Yajra\DataTables\Html;

use Exception;
use Illuminate\Support\Arr;

trait HasTable
{
    /**
     * Retrieves HTML table attribute value.
     *
     * @param  string  $attribute
     * @return string
     * @throws \Exception
     */
    public function getTableAttribute(string $attribute): string
    {
        if (! array_key_exists($attribute, $this->tableAttributes)) {
            throw new Exception("Table attribute '$attribute' does not exist.");
        }

        return $this->tableAttributes[$attribute] ?? '';
    }

    /**
     * Get table computed table attributes.
     *
     * @return array
     */
    public function getTableAttributes(): array
    {
        return $this->tableAttributes;
    }

    /**
     * Sets HTML table "id" attribute.
     *
     * @param  string  $id
     * @return $this
     */
    public function setTableId(string $id): static
    {
        return $this->setTableAttribute('id', $id);
    }

    /**
     * Get HTML table "id" attribute.
     *
     * @return string
     * @throws \Exception
     */
    public function getTableId(): string
    {
        return $this->getTableAttribute('id');
    }

    /**
     * Sets HTML table attribute(s).
     *
     * @param  array|string  $attribute
     * @param  string|null  $value
     * @return $this
     */
    public function setTableAttribute(array|string $attribute, string $value = null): static
    {
        if (is_array($attribute)) {
            return $this->setTableAttributes($attribute);
        }

        $this->tableAttributes[$attribute] = $value;

        return $this;
    }

    /**
     * Sets multiple HTML table attributes at once.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function setTableAttributes(array $attributes): static
    {
        foreach ($attributes as $attribute => $value) {
            $this->tableAttributes[$attribute] = $value;
        }

        return $this;
    }

    /**
     * Add class names to the "class" attribute of HTML table.
     *
     * @param  array|string  $class
     * @return $this
     */
    public function addTableClass(array|string $class): static
    {
        $class = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = Arr::get(array_change_key_case($this->tableAttributes), 'class');

        $classes = preg_split('#\s+#', $currentClass.' '.$class, -1, PREG_SPLIT_NO_EMPTY);
        $class = implode(' ', array_unique((array) $classes));

        return $this->setTableAttribute('class', $class);
    }

    /**
     * Remove class names from the "class" attribute of HTML table.
     *
     * @param  array|string  $class
     * @return $this
     */
    public function removeTableClass(array|string $class): static
    {
        $class = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = Arr::get(array_change_key_case($this->tableAttributes), 'class');

        $classes = array_diff(
            (array) preg_split('#\s+#', $currentClass, -1, PREG_SPLIT_NO_EMPTY),
            (array) preg_split('#\s+#', $class, -1, PREG_SPLIT_NO_EMPTY)
        );
        $class = implode(' ', array_unique($classes));

        return $this->setTableAttribute('class', $class);
    }

    /**
     * Compile table headers and to support responsive extension.
     *
     * @return array
     */
    protected function compileTableHeaders(): array
    {
        $th = [];
        foreach ($this->collection->toArray() as $row) {
            $thAttr = $this->html->attributes(array_merge(
                Arr::only($row, ['class', 'id', 'title', 'width', 'style', 'data-class', 'data-hide']),
                $row['attributes'],
                isset($row['titleAttr']) ? ['title' => $row['titleAttr']] : []
            ));
            $th[] = '<th '.$thAttr.'>'.$row['title'].'</th>';
        }

        return $th;
    }

    /**
     * Compile table search headers.
     *
     * @return array
     */
    protected function compileTableSearchHeaders(): array
    {
        $search = [];
        foreach ($this->collection->all() as $key => $row) {
            $search[] = $row['searchable'] ? '<th>'.($row->search ?? '').'</th>' : '<th></th>';
        }

        return $search;
    }

    /**
     * Compile table footer contents.
     *
     * @return array
     */
    protected function compileTableFooter(): array
    {
        $footer = [];
        foreach ($this->collection->all() as $row) {
            if (is_array($row->footer)) {
                $footerAttr = $this->html->attributes(Arr::only($row->footer,
                    ['class', 'id', 'title', 'width', 'style', 'data-class', 'data-hide']));
                $title = $row->footer['title'] ?? '';
                $footer[] = '<th '.$footerAttr.'>'.$title.'</th>';
            } else {
                $footer[] = '<th>'.$row->footer.'</th>';
            }
        }

        return $footer;
    }
}
