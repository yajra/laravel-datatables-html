<?php

namespace Yajra\DataTables\Html\Options\Plugins;

/**
 * DataTables - Column control plugin option builder.
 *
 * @see https://datatables.net/extensions/columncontrol/
 * @see https://datatables.net/extensions/columncontrol/config
 */
trait ColumnControl
{
    /**
     * Set column control options.
     *
     * @see https://www.datatables.net/extensions/columncontrol/
     */
    public function columnControl(array $options): static
    {
        $this->attributes['columnControl'] = $options;

        return $this;
    }

    protected function addColumnControl(int|string $target, array $content): static
    {
        if (! isset($this->attributes['columnControl']) || ! is_array($this->attributes['columnControl'])) {
            $this->attributes['columnControl'] = [];
        }

        // get existing target and merge content if exists
        foreach ($this->attributes['columnControl'] as &$control) {
            if (isset($control['target']) && $control['target'] === $target) {
                $control['content'] = array_unique(
                    array_merge($control['content'] ?? [], $content)
                );

                return $this;
            }
        }

        $this->attributes['columnControl'][] = ['target' => $target, 'content' => $content];

        return $this;
    }

    public function columnControlHeader(array $content, int $target = 0): static
    {
        $this->addColumnControl('thead:'.$target, $content);

        return $this;
    }

    public function columnControlFooter(array $content, int $target = 0): static
    {
        $this->addColumnControl('tfoot:'.$target, $content);

        return $this;
    }

    public function columnControlFooterSearch(array $content = []): static
    {
        $this->addColumnControl('tfoot', [$content] ?? ['search']);

        return $this;
    }

    public function columnControlSearchDropdown(int|string $target = 0): static
    {
        $this->addColumnControl($target, ['order', 'searchDropdown'])
            ->ordering(['indicators' => false, 'handler' => false]);

        return $this;
    }

    public function columnControlSearch(?array $content = null, int|string $target = 1): static
    {
        $this->addColumnControl($target, $content ?? ['search']);

        return $this;
    }

    public function columnControlSpacer(int|string $target = 1): static
    {
        $this->addColumnControl($target, [['extend' => 'spacer']]);

        return $this;
    }
}
