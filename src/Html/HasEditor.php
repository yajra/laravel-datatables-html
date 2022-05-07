<?php

namespace Yajra\DataTables\Html;

use Yajra\DataTables\Html\Editor\Editor;

trait HasEditor
{
    /**
     * Collection of Editors.
     *
     * @var array
     */
    protected array $editors = [];

    /**
     * Attach multiple editors to builder.
     *
     * @param  array|mixed  ...$editors
     * @return $this
     * @throws \Exception
     * @see https://editor.datatables.net/
     */
    public function editors(...$editors): static
    {
        if (is_array($editors[0])) {
            $editors = $editors[0];
        }

        foreach ($editors as $editor) {
            $this->editor($editor);
        }

        return $this;
    }

    /**
     * Integrate with DataTables Editor.
     *
     * @param  Editor  $fields
     * @return $this
     * @throws \Exception
     * @see https://editor.datatables.net/
     */
    public function editor(Editor $fields): static
    {
        $this->setTemplate($this->config->get('datatables-html.editor', 'datatables::editor'));

        $editor = $this->newEditor($fields);

        $this->editors[] = $editor;

        return $this;
    }

    /**
     * @param  array|Editor  $fields
     * @return Editor
     * @throws \Exception
     */
    protected function newEditor(Editor|array $fields): Editor
    {
        if ($fields instanceof Editor) {
            $editor = $fields;
        } else {
            $editor = new Editor;
            $editor->fields($fields);
        }

        if (! $editor->table) {
            $editor->table('#'.$this->getTableAttribute('id'));
        }

        if (! $editor->ajax) {
            $editor->ajax($this->getAjaxUrl());
        }

        return $editor;
    }

    /**
     * @return array
     */
    public function getEditors(): array
    {
        return $this->editors;
    }
}
