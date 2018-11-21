<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - FixedHeader plugin option builder.
 *
 * @see https://datatables.net/extensions/fixedheader/
 * @see https://datatables.net/reference/option/fixedHeader
 * @see https://datatables.net/reference/option/#fixedHeader
 */
trait FixedHeader
{
    /**
     * Set fixedHeader option value.
     *
     * @param bool|array $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedHeader
     */
    public function fixedHeader($value = true)
    {
        $this->attributes['fixedHeader'] = $value;

        return $this;
    }

    /**
     * Set fixedHeader footer option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedHeader.footer
     */
    public function fixedHeaderFooter(bool $value = true)
    {
        $this->attributes['fixedHeader']['footer'] = $value;

        return $this;
    }

    /**
     * Set fixedHeader footerOffset option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedHeader.footerOffset
     */
    public function fixedHeaderFooterOffset(int $value = 0)
    {
        $this->attributes['fixedHeader']['footerOffset'] = $value;

        return $this;
    }

    /**
     * Set fixedHeader header option value.
     *
     * @param bool $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedHeader.header
     */
    public function fixedHeaderHeader(bool $value = true)
    {
        $this->attributes['fixedHeader']['header'] = $value;

        return $this;
    }

    /**
     * Set fixedHeader headerOffset option value.
     *
     * @param int $value
     * @return $this
     * @see https://datatables.net/reference/option/fixedHeader.headerOffset
     */
    public function fixedHeaderHeaderOffset(int $value = 0)
    {
        $this->attributes['fixedHeader']['headerOffset'] = $value;

        return $this;
    }
}
