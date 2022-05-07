<?php

namespace Yajra\DataTables\Html\Editor\Fields;

/**
 * @see https://editor.datatables.net/reference/field/upload
 * @see https://editor.datatables.net/examples/advanced/upload.html
 * @see https://editor.datatables.net/examples/advanced/upload-many.html
 */
class File extends Field
{
    protected string $type = 'upload';

    /**
     * Editor instance variable name.
     *
     * @var string
     */
    protected string $editor = 'editor';

    /**
     * @param  array|string  $name
     * @param  string  $label
     * @return static
     */
    public static function make(array|string $name, string $label = ''): static
    {
        /** @var \Yajra\DataTables\Html\Editor\Fields\File $field */
        $field = parent::make($name, $label);

        return $field->displayFile()->clearText()->noImageText();
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function ajax(string $value): static
    {
        $this->attributes['ajax'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function ajaxData(string $value): static
    {
        $this->attributes['ajaxData'] = $value;

        return $this;
    }

    /**
     * @param  bool  $value
     * @return $this
     */
    public function dragDrop(bool $value = true): static
    {
        $this->attributes['dragDrop'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function dragDropText(string $value): static
    {
        $this->attributes['dragDropText'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function fileReadText(string $value): static
    {
        $this->attributes['fileReadText'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function noFileText(string $value): static
    {
        $this->attributes['noFileText'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function processingText(string $value): static
    {
        $this->attributes['processingText'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function uploadText(string $value): static
    {
        $this->attributes['uploadText'] = $value;

        return $this;
    }

    /**
     * Set editor instance for file upload.
     *
     * @param  string  $editor
     * @return $this
     */
    public function editor(string $editor): static
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * Display image upon upload.
     *
     * @return $this
     */
    public function displayImage(): static
    {
        // TODO: Use Laravel filesystem instead of hard coded storage path
        return $this->display(<<<SCRIPT
            function (file_id) { 
                return file_id ? '<img src="storage/' + file_id + '" alt=""/>' : null; 
            }
SCRIPT
        );
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function display(string $value): static
    {
        $this->attributes['display'] = $value;

        return $this;
    }

    /**
     * Display the file path.
     *
     * @return $this
     */
    public function displayFile(): static
    {
        return $this->display("function (file_id) { return file_id; }");
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function clearText(string $value = 'Clear'): static
    {
        $this->attributes['clearText'] = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function noImageText(string $value = 'No image'): static
    {
        $this->attributes['noImageText'] = $value;

        return $this;
    }

    /**
     * @param  bool  $state
     * @return $this
     */
    public function multiple(bool $state = true): static
    {
        if ($state) {
            $this->type('uploadMany');
        }

        return $this;
    }
}
