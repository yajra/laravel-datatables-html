<?php

namespace Yajra\DataTables\Html\Editor\Fields;

/**
 * @see https://editor.datatables.net/reference/field/upload
 * @see https://editor.datatables.net/examples/advanced/upload.html
 * @see https://editor.datatables.net/examples/advanced/upload-many.html
 */
class File extends Field
{
    protected $type = 'upload';

    /**
     * Editor instance.
     *
     * @var string
     */
    protected $editor = 'editor';

    /**
     * @param string $name
     * @param string $label
     * @return static|\Yajra\DataTables\Html\Editor\Fields\Field
     */
    public static function make($name, $label = '')
    {
        /** @var \Yajra\DataTables\Html\Editor\Fields\File $field */
        $field = parent::make($name, $label);

        return $field->displayFile()->clearText()->noImageText();
    }

    /**
     * @param string $value
     * @return $this
     */
    public function ajax($value)
    {
        $this->attributes['ajax'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function ajaxData($value)
    {
        $this->attributes['ajaxData'] = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function dragDrop($value = true)
    {
        $this->attributes['dragDrop'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function dragDropText($value)
    {
        $this->attributes['dragDropText'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function fileReadText($value)
    {
        $this->attributes['fileReadText'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function noFileText($value)
    {
        $this->attributes['noFileText'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function processingText($value)
    {
        $this->attributes['processingText'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function uploadText($value)
    {
        $this->attributes['uploadText'] = $value;

        return $this;
    }

    /**
     * Set editor instance for file upload.
     *
     * @param string $editor
     * @return $this
     */
    public function editor($editor)
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * Display image upon upload.
     *
     * @return $this
     */
    public function displayImage()
    {
        return $this->display("function (file_id) { return file_id ? '<img src=\"storage/' + file_id + '\"/>' : null; }");
    }

    /**
     * @param string $value
     * @return $this
     */
    public function display($value)
    {
        $this->attributes['display'] = $value;

        return $this;
    }

    /**
     * Display the file path.
     *
     * @return $this
     */
    public function displayFile()
    {
        return $this->display("function (file_id) { return file_id; }");
    }

    /**
     * @param string $value
     * @return $this
     */
    public function clearText($value = 'Clear')
    {
        $this->attributes['clearText'] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function noImageText($value = 'No image')
    {
        $this->attributes['noImageText'] = $value;

        return $this;
    }

    /**
     * @param bool $state
     * @return $this
     */
    public function multiple($state = true)
    {
        if ($state) {
            $this->type('uploadMany');
        }

        return $this;
    }
}
