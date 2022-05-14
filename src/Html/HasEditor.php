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
     * @see https://editor.datatables.net/
     */
    public function editors(...$editors): static
    {
        if (is_array($editors[0])) {
            $editors = $editors[0];
        }

        $collection = [];
        foreach ($editors as $editor) {
            $collection[] = $this->editor($editor);
        }

        $this->editors = $collection;

        return $this;
    }

    /**
     * Integrate with DataTables Editor.
     *
     * @param  Editor  $editor
     * @return $this
     * @see https://editor.datatables.net/
     */
    public function editor(Editor $editor): static
    {
        /** @var string $template */
        $template = $this->config->get('datatables-html.editor', 'datatables::editor');

        $this->setTemplate($template);

        if (! $editor->table) {
            $editor->table('#'.$this->getTableAttribute('id'));
        }

        if (! $editor->ajax) {
            $editor->ajax($this->getAjaxUrl());
        }

        $this->editors[] = $editor;

        return $this;
    }

    /**
     * @return array
     */
    public function getEditors(): array
    {
        return $this->editors;
    }
}
