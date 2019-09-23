<?php

namespace Yajra\DataTables\Html\Editor;

use Illuminate\Support\Str;

/**
 * @method Editor onClose($script)
 * @method Editor onCreate($script)
 * @method Editor onDisplayOrder($script)
 * @method Editor onEdit($script)
 * @method Editor onInitCreate($script)
 * @method Editor onInitEdit($script)
 * @method Editor onInitRemove($script)
 * @method Editor onInitSubmit($script)
 * @method Editor onOpen($script)
 * @method Editor onPostCreate($script)
 * @method Editor onPostEdit($script)
 * @method Editor onPostRemove($script)
 * @method Editor onPostSubmit($script)
 * @method Editor onPostUpload($script)
 * @method Editor onPreBlur($script)
 * @method Editor onPreBlurCancelled($script)
 * @method Editor onPreCreate($script)
 * @method Editor onPreEdit($script)
 * @method Editor onPreOpen($script)
 * @method Editor onPreOpenCancelled($script)
 * @method Editor onPreRemove($script)
 * @method Editor onPreSubmit($script)
 * @method Editor onPreSubmitCancelled($script)
 * @method Editor onPreUpload($script)
 * @method Editor onPreUploadCancelled($script)
 * @method Editor onProcessing($script)
 * @method Editor onRemove($script)
 * @method Editor onSetData($script)
 * @method Editor onSubmitComplete($script)
 * @method Editor onSubmitError($script)
 * @method Editor onSubmitSuccess($script)
 * @method Editor onSubmitUnsuccessful($script)
 * @method Editor onUploadXhrError($script)
 * @method Editor onUploadXhrSuccess($script)
 */
trait HasEvents
{
    /**
     * Magic method handler for editor events.
     *
     * @param string $name
     * @param mixed $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
        if (Str::startsWith($name, 'on')) {
            $event = Str::camel(substr($name, 2, strlen($name) - 2));

            return $this->on($event, $arguments[0]);
        }

        return parent::__call($name, $arguments);
    }

    /**
     * Add Editor event listener scripts.
     *
     * @param string $event
     * @param string $script
     * @return $this
     * @see https://editor.datatables.net/reference/event
     */
    public function on($event, $script)
    {
        $this->attributes['events'][] = [
            'event' => $event,
            'script' => value($script),
        ];

        return $this;
    }
}
