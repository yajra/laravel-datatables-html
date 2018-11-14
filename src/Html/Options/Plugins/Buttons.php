<?php

namespace Yajra\DataTables\Html\Options\Plugins;

use Illuminate\Contracts\Support\Arrayable;

/**
 * DataTables - Buttons plugin option builder.
 *
 * @see https://datatables.net/extensions/buttons/
 * @see https://datatables.net/reference/option/buttons
 */
trait Buttons
{
    /**
     * Attach multiple buttons to builder.
     *
     * @param mixed ...$buttons
     * @return $this
     * @see https://www.datatables.net/extensions/buttons/
     */
    public function buttons(...$buttons)
    {
        foreach ($buttons as $button) {
            $this->attributes['buttons'][] = $button instanceof Arrayable ? $button->toArray() : $button;
        }

        return $this;
    }
}
