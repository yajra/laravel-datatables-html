<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;

class ColumnDefinition extends Fluent
{
    use Options\HasFeatures;
    use Options\HasCallbacks;
    use Options\HasInternationalisation;
    use Options\Plugins\AutoFill;
    use Options\Plugins\Buttons;
    use Options\Plugins\ColReorder;
    use Options\Plugins\FixedColumns;
    use Options\Plugins\FixedHeader;
    use Options\Plugins\KeyTable;
    use Options\Plugins\Responsive;
    use Options\Plugins\RowGroup;
    use Options\Plugins\RowReorder;
    use Options\Plugins\Scroller;
    use Options\Plugins\Select;
    use Options\Plugins\SearchPanes;

    public function targets(array $value): static
    {
        $this->attributes['targets'] = $value;

        return $this;
    }
}
