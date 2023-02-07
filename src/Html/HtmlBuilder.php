<?php

namespace Yajra\DataTables\Html;

class HtmlBuilder
{
    public function attributes(array $attributes): string
    {
        $html = [];
        foreach ($attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);
            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' '.implode(' ', $html) : '';
    }

    private function attributeElement(int|string $key, mixed $value): ?string
    {
        if (is_numeric($key)) {
            $key = $value;
        }

        if (! is_null($value)) {
            return $key.'="'.e($value).'"';
        }

        return null;
    }
}
