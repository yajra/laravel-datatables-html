<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - Responsive plugin option builder.
 *
 * @see https://datatables.net/extensions/responsive
 * @see https://datatables.net/reference/option/responsive
 * @see https://datatables.net/reference/option/#responsive
 */
trait Responsive
{
    /**
     * Set responsive option value.
     *
     * @param  bool|array  $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive
     */
    public function responsive(bool|array $value = true): static
    {
        $this->attributes['responsive'] = $value;

        return $this;
    }

    /**
     * Set responsive breakpoints option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.breakpoints
     */
    public function responsiveBreakpoints(mixed $value): static
    {
        $this->attributes['responsive']['breakpoints'] = $value;

        return $this;
    }

    /**
     * Set responsive details option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.details
     */
    public function responsiveDetails(mixed $value): static
    {
        $this->attributes['responsive']['details'] = $value;

        return $this;
    }

    /**
     * Set responsive details display option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.details.display
     */
    public function responsiveDetailsDisplay(mixed $value): static
    {
        $this->attributes['responsive']['details']['display'] = $value;

        return $this;
    }

    /**
     * Set responsive details renderer option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.details.renderer
     */
    public function responsiveDetailsRenderer(mixed $value): static
    {
        $this->attributes['responsive']['details']['renderer'] = $value;

        return $this;
    }

    /**
     * Set responsive details target option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.details.target
     */
    public function responsiveDetailsTarget(mixed $value): static
    {
        $this->attributes['responsive']['details']['target'] = $value;

        return $this;
    }

    /**
     * Set responsive details type option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.details.type
     */
    public function responsiveDetailsType(mixed $value): static
    {
        $this->attributes['responsive']['details']['type'] = $value;

        return $this;
    }

    /**
     * Set responsive orthogonal option value.
     *
     * @param mixed $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.orthogonal
     */
    public function responsiveOrthogonal(mixed $value): static
    {
        $this->attributes['responsive']['orthogonal'] = $value;

        return $this;
    }
}
