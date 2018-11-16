<?php

namespace Yajra\DataTables\Html;

use Yajra\DataTables\Html\Editor\Editor;

trait HasEditor
{
    /**
     * Collection of Editors.
     *
     * @var null|Editor
     */
    protected $editors = [];

    /**
     * Attach multiple editors to builder.
     *
     * @param mixed ...$editors
     * @return $this
     * @see https://editor.datatables.net/
     * @throws \Exception
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
     * @throws \Exception
     */
    public function editor($fields)
    {
        $this->setTemplate($this->config->get('datatables-html.editor', 'datatables::editor'));

        $editor = $this->newEditor($fields);

        $this->editors[] = $editor;

        return $this;
    }

    /**
     * @param array|Editor $fields
     * @return array|Editor
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
}
