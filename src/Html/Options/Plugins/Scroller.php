<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - Scroller plugin option builder.
 *
 * @see https://datatables.net/extensions/scroller
 * @see https://datatables.net/reference/option/scroller
 * @see https://datatables.net/reference/option/#scroller
 */
trait Scroller
{
    /**
     * Set scroller option value.
     *
     * @param  bool|array  $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller
     */
    public function scroller(bool|array $value = true): static
    {
        $this->attributes['scroller'] = $value;

        return $this;
    }

    /**
     * Set scroller boundaryScale option value.
     *
     * @param  float  $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller.boundaryScale
     */
    public function scrollerBoundaryScale(float $value = 0.5): static
    {
        return $this->scroller(['boundaryScale' => $value]);
    }

    /**
     * Set scroller displayBuffer option value.
     *
     * @param  int  $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller.displayBuffer
     */
    public function scrollerDisplayBuffer(int $value = 9): static
    {
        return $this->scroller(['displayBuffer' => $value]);
    }

    /**
     * Set scroller loadingIndicator option value.
     *
     * @param  bool  $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller.loadingIndicator
     */
    public function scrollerLoadingIndicator(bool $value = true): static
    {
        return $this->scroller(['loadingIndicator' => $value]);
    }

    /**
     * Set scroller rowHeight option value.
     *
     * @param  int|string  $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller.rowHeight
     */
    public function scrollerRowHeight(int|string $value = 'auto'): static
    {
        return $this->scroller(['rowHeight' => $value]);
    }

    /**
     * Set scroller serverWait option value.
     *
     * @param  int  $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller.serverWait
     */
    public function scrollerServerWait(int $value = 200): static
    {
        return $this->scroller(['serverWait' => $value]);
    }
}
