<?php

namespace Yajra\DataTables\Html\Options;

/**
 * DataTables - Callbacks option builder.
 *
 * @see https://datatables.net/reference/option/
 */
trait HasCallbacks
{
    /**
     * Set createdRow option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/createdRow
     */
    public function createdRow(mixed $script): static
    {
        $this->attributes['createdRow'] = $script;

        return $this;
    }

    /**
     * Set drawCallback option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/drawCallback
     */
    public function drawCallback($script)
    {
        $this->attributes['drawCallback'] = $script;

        return $this;
    }

    /**
     * Set drawCallback option value with Livewire integration.
     * Solution as per issue https://github.com/yajra/laravel-datatables/issues/2401.
     *
     * @param mixed|null $script
     * @return $this
     * @see https://datatables.net/reference/option/drawCallback
     */
    public function drawCallbackWithLivewire($script = null)
    {
        $js = "function(settings) {
            if (window.livewire) {
                window.livewire.rescan();
            }

            $script
        }";

        $this->attributes['drawCallback'] = $js;

        return $this;
    }

    /**
     * Set footerCallback option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/footerCallback
     */
    public function footerCallback($script)
    {
        $this->attributes['footerCallback'] = $script;

        return $this;
    }

    /**
     * Set formatNumber option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/formatNumber
     */
    public function formatNumber($script)
    {
        $this->attributes['formatNumber'] = $script;

        return $this;
    }

    /**
     * Set headerCallback option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/headerCallback
     */
    public function headerCallback($script)
    {
        $this->attributes['headerCallback'] = $script;

        return $this;
    }

    /**
     * Set infoCallback option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/infoCallback
     */
    public function infoCallback($script)
    {
        $this->attributes['infoCallback'] = $script;

        return $this;
    }

    /**
     * Set initComplete option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/initComplete
     */
    public function initComplete($script)
    {
        $this->attributes['initComplete'] = $script;

        return $this;
    }

    /**
     * Set preDrawCallback option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/preDrawCallback
     */
    public function preDrawCallback($script)
    {
        $this->attributes['preDrawCallback'] = $script;

        return $this;
    }

    /**
     * Set rowCallback option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/rowCallback
     */
    public function rowCallback($script)
    {
        $this->attributes['rowCallback'] = $script;

        return $this;
    }

    /**
     * Set stateLoadCallback option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/stateLoadCallback
     */
    public function stateLoadCallback($script)
    {
        $this->attributes['stateLoadCallback'] = $script;

        return $this;
    }

    /**
     * Set stateLoaded option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/stateLoaded
     */
    public function stateLoaded($script)
    {
        $this->attributes['stateLoaded'] = $script;

        return $this;
    }

    /**
     * Set stateLoadParams option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/stateLoadParams
     */
    public function stateLoadParams($script)
    {
        $this->attributes['stateLoadParams'] = $script;

        return $this;
    }

    /**
     * Set stateSaveCallback option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/stateSaveCallback
     */
    public function stateSaveCallback($script)
    {
        $this->attributes['stateSaveCallback'] = $script;

        return $this;
    }

    /**
     * Set stateSaveParams option value.
     *
     * @param mixed $script
     * @return $this
     * @see https://datatables.net/reference/option/stateSaveParams
     */
    public function stateSaveParams($script)
    {
        $this->attributes['stateSaveParams'] = $script;

        return $this;
    }
}
