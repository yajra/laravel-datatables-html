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
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller
     */
    public function scroller($value = true)
    {
        $this->attributes['scroller'] = $value;

        return $this;
    }

    /**
     * Set scroller boundaryScale option value.
     *
     * @param float $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller.boundaryScale
     */
    public function scrollerBoundaryScale($value = 0.5)
    {
        $this->attributes['scroller']['boundaryScale'] = $value;

        return $this;
    }

    /**
     * Set scroller displayBuffer option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller.displayBuffer
     */
    public function scrollerDisplayBuffer($value = 9)
    {
        $this->attributes['scroller']['displayBuffer'] = $value;

        return $this;
    }

    /**
     * Set scroller loadingIndicator option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller.loadingIndicator
     */
    public function scrollerLoadingIndicator(bool $value = true)
    {
        $this->attributes['scroller']['loadingIndicator'] = $value;

        return $this;
    }

    /**
     * Set scroller rowHeight option value.
     *
     * @param int|string $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller.rowHeight
     */
    public function scrollerRowHeight($value = 'auto')
    {
        $this->attributes['scroller']['rowHeight'] = $value;

        return $this;
    }

    /**
     * Set scroller serverWait option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/scroller.serverWait
     */
    public function scrollerServerWait($value = 200)
    {
        $this->attributes['scroller']['serverWait'] = $value;

        return $this;
    }
}
