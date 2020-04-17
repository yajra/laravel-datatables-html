<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Arr;

trait HasTable
{
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
     * Add class names to the "class" attribute of HTML table.
     *
     * @param string|array $class
     * @return $this
     */
    public function addTableClass($class)
    {
        $class = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = Arr::get(array_change_key_case($this->tableAttributes), 'class');

        $classes = preg_split('#\s+#', $currentClass . ' ' . $class, null, PREG_SPLIT_NO_EMPTY);
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
     * Compile table headers and to support responsive extension.
     *
     * @return array
     */
    protected function compileTableHeaders()
    {
        $th = [];
        foreach ($this->collection->toArray() as $row) {
            $thAttr = $this->html->attributes(array_merge(
                Arr::only($row, ['class', 'id', 'title', 'width', 'style', 'data-class', 'data-hide']),
                $row['attributes'],
                isset($row['titleAttr']) ? ['title' => $row['titleAttr']] : []
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
    protected function compileTableSearchHeaders()
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
    protected function compileTableFooter()
    {
        $footer = [];
        foreach ($this->collection->all() as $row) {
            if (is_array($row->footer)) {
                $footerAttr = $this->html->attributes(Arr::only($row->footer,
                    ['class', 'id', 'title', 'width', 'style', 'data-class', 'data-hide']));
                $title = isset($row->footer['title']) ? $row->footer['title'] : '';
                $footer[] = '<th ' . $footerAttr . '>' . $title . '</th>';
            } else {
                $footer[] = '<th>' . $row->footer . '</th>';
            }
        }

        return $footer;
    }
}
