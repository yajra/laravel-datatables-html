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
     * Set responsive breakpoints option value.
     *
     * @param  array  $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.breakpoints
     */
    public function responsiveBreakpoints(array $value): static
    {
        return $this->responsive(['breakpoints' => $value]);
    }

    /**
     * Set responsive option value.
     *
     * @param  bool|array  $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive
     */
    public function responsive(bool|array $value = true): static
    {
        if (is_array($value)) {
            $this->attributes['responsive'] = array_merge((array) $this->attributes['responsive'], $value);
        } else {
            $this->attributes['responsive'] = $value;
        }

        return $this;
    }

    /**
     * Set responsive details display option value.
     *
     * @param  array|string  $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.details.display
     */
    public function responsiveDetailsDisplay(array|string $value): static
    {
        return $this->responsiveDetails(['display' => $value]);
    }

    /**
     * Set responsive details option value.
     *
     * @param  bool|array  $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.details
     */
    public function responsiveDetails(bool|array $value): static
    {
        $responsive = (array) $this->getResponsive();
        if (is_array($value)) {
            $responsive['details'] = array_merge((array) ($responsive['details'] ?? []), $value);
        } else {
            $responsive['details'] = $value;
        }

        return $this->responsive($responsive);
    }

    /**
     * Set responsive details renderer option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.details.renderer
     */
    public function responsiveDetailsRenderer(string $value): static
    {
        return $this->responsiveDetails(['renderer' => $value]);
    }

    /**
     * Set responsive details target option value.
     *
     * @param  int|string  $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.details.target
     */
    public function responsiveDetailsTarget(int|string $value): static
    {
        return $this->responsiveDetails(['target' => $value]);
    }

    /**
     * Set responsive details type option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.details.type
     */
    public function responsiveDetailsType(string $value): static
    {
        return $this->responsiveDetails(['type' => $value]);
    }

    /**
     * Set responsive orthogonal option value.
     *
     * @param  string  $value
     * @return $this
     * @see https://datatables.net/reference/option/responsive.orthogonal
     */
    public function responsiveOrthogonal(string $value): static
    {
        return $this->responsive(['orthogonal' => $value]);
    }

    /**
     * @param  string|null  $key
     * @return mixed
     */
    public function getResponsive(string $key = null): mixed
    {
        if (is_null($key)) {
            return $this->attributes['responsive'] ?? true;
        }

        return $this->attributes['responsive'][$key] ?? false;
    }
}
