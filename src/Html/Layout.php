<?php

declare(strict_types=1);

namespace Yajra\DataTables\Html;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Macroable;
use InvalidArgumentException;
use Throwable;
use Yajra\DataTables\Html\Enums\LayoutPosition;

class Layout extends Fluent
{
    use Macroable;

    public static function make(array $options = []): static
    {
        return new static($options);
    }

    public function top(array|string|null $options, ?int $order = null): static
    {
        $this->attributes[LayoutPosition::Top->withOrder($order)] = $options;

        return $this;
    }

    public function topStart(string|array|null $options, ?int $order = null): static
    {
        $this->attributes[LayoutPosition::TopStart->withOrder($order)] = $options;

        return $this;
    }

    public function topEnd(string|array|null $options, ?int $order = null): static
    {
        $this->attributes[LayoutPosition::TopEnd->withOrder($order)] = $options;

        return $this;
    }

    public function topView(string $selector, ?int $order = null): static
    {
        return $this->top($this->renderCustomElement($selector), $order);
    }

    public function topStartView(string $selector, ?int $order = null): static
    {
        return $this->topStart($this->renderCustomElement($selector), $order);
    }

    public function topEndView(string $selector, ?int $order = null): static
    {
        return $this->topEnd($this->renderCustomElement($selector), $order);
    }

    public function bottom(array|string|null $options, ?int $order = null): static
    {
        $this->attributes[LayoutPosition::Bottom->withOrder($order)] = $options;

        return $this;
    }

    public function bottomStart(string|array|null $options, ?int $order = null): static
    {
        $this->attributes[LayoutPosition::BottomStart->withOrder($order)] = $options;

        return $this;
    }

    public function bottomEnd(string|array|null $options, ?int $order = null): static
    {
        $this->attributes[LayoutPosition::BottomEnd->withOrder($order)] = $options;

        return $this;
    }

    public function bottomView(string $selector, ?int $order = null): static
    {
        return $this->bottom($this->renderCustomElement($selector), $order);
    }

    public function bottomStartView(string $selector, ?int $order = null): static
    {
        return $this->bottomStart($this->renderCustomElement($selector), $order);
    }

    public function bottomEndView(string $selector, ?int $order = null): static
    {
        return $this->bottomEnd($this->renderCustomElement($selector), $order);
    }

    /**
     * @param  Renderable|view-string  $view
     *
     * @throws Throwable
     */
    public function addView(
        Renderable|string $view,
        LayoutPosition $layoutPosition,
        ?int $order = null
    ): static {
        $html = $view instanceof Renderable ? $view->render() : view($view)->render();
        $element = json_encode($html);

        if ($element === false) {
            throw new InvalidArgumentException("Cannot render view [$html] to json.");
        }

        $this->attributes[$layoutPosition->withOrder($order)] = $this->renderCustomElement($element, false);

        return $this;
    }

    private function renderCustomElement(string $element, bool $asJsSelector = true): string
    {
        $html = $asJsSelector ? "$('{$element}').html()" : $element;

        return "function() { return $html; }";
    }
}
