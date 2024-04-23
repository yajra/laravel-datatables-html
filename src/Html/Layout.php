<?php

declare(strict_types=1);

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Macroable;

class Layout extends Fluent
{
    use Macroable;

    public function topStart(string|array|null $options, int $order = 0): static
    {
        return $this->top($options, $order, 'Start');
    }

    public function topEnd(string|array|null $options, int $order = 0): static
    {
        return $this->top($options, $order, 'End');
    }

    public function bottomStart(string|array|null $options, int $order = 0): static
    {
        return $this->bottom($options, $order, 'Start');
    }

    public function bottomEnd(string|array|null $options, int $order = 0): static
    {
        return $this->bottom($options, $order, 'End');
    }

    public function top(array|string|null $options, ?int $order = null, ?string $position = null): static
    {
        if ($order > 0) {
            $this->attributes["top{$order}{$position}"] = $options;
        } else {
            $this->attributes["top{$position}"] = $options;
        }

        return $this;
    }

    public function bottom(array|string|null $options, ?int $order = null, ?string $position = null): static
    {
        if ($order > 0) {
            $this->attributes["bottom{$order}{$position}"] = $options;
        } else {
            $this->attributes["bottom{$position}"] = $options;
        }

        return $this;
    }
}
