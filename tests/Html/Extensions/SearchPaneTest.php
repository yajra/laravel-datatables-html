<?php

namespace Yajra\DataTables\Html\Tests\Html\Extensions;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Yajra\DataTables\Html\SearchPane;
use Yajra\DataTables\Html\Tests\Models\User;
use Yajra\DataTables\Html\Tests\TestCase;

class SearchPaneTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_has_setters()
    {
        $pane = SearchPane::make();
        $pane->className('className')
            ->header('header')
            ->show()
            ->name('name')
            ->orthogonal('orthogonal')
            ->hideTotal()
            ->threshold(1)
            ->hideCount()
            ->filterChanged('filterChanged')
            ->emptyMessage('emptyMessage')
            ->dtOpts([])
            ->controls()
            ->columns([])
            ->clear()
            ->cascadePanes();

        $this->assertInstanceOf(SearchPane::class, $pane);
        $this->assertEquals('className', $pane->className);
        $this->assertEquals('header', $pane->header);
        $this->assertEquals(true, $pane->show);
        $this->assertEquals('name', $pane->name);
        $this->assertEquals('orthogonal', $pane->orthogonal);
        $this->assertEquals(false, $pane->viewTotal);
        $this->assertEquals(1, $pane->threshold);
        $this->assertEquals(true, $pane->hideCount);
        $this->assertEquals('filterChanged', $pane->filterChanged);
        $this->assertEquals('emptyMessage', $pane->emptyMessage);
        $this->assertEquals([], $pane->dtOpts);
        $this->assertEquals(true, $pane->controls);
        $this->assertEquals([], $pane->columns);
        $this->assertEquals(true, $pane->clear);
        $this->assertEquals(true, $pane->cascadePanes);

        $pane->viewTotal();
        $this->assertEquals(true, $pane->viewTotal);
    }

    #[Test]
    public function it_has_options()
    {
        $pane = SearchPane::make()->options([1, 2, 3]);

        $this->assertEquals([1, 2, 3], $pane->options);
        $this->assertCount(3, $pane->options);

        $pane->modelOptions(User::class, 'name');
        $this->assertCount(20, $pane->options);
        $this->assertIsArray($pane->options[0]);
        $this->assertEquals(['value' => 1, 'label' => 'Record-1'], $pane->options[0]);
        $this->assertEquals(['value' => 10, 'label' => 'Record-10'], $pane->options[9]);

        $pane->tableOptions('users', 'name');
        $this->assertCount(20, $pane->options);
        $this->assertIsArray($pane->options[0]);
        $this->assertEquals(['value' => 1, 'label' => 'Record-1'], $pane->options[0]);
        $this->assertEquals(['value' => 10, 'label' => 'Record-10'], $pane->options[9]);
    }
}
