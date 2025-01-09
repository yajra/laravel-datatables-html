<?php

namespace Yajra\DataTables\Html\Tests\Html\Builder;

use InvalidArgumentException;
use Livewire\Exceptions\ComponentNotFoundException;
use PHPUnit\Framework\Attributes\Test;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Enums\LayoutPosition;
use Yajra\DataTables\Html\Layout;
use Yajra\DataTables\Html\Tests\TestCase;
use Yajra\DataTables\Html\Tests\TestComponents\TestInlineView;
use Yajra\DataTables\Html\Tests\TestComponents\TestLivewire;
use Yajra\DataTables\Html\Tests\TestComponents\TestView;

class LayoutTest extends TestCase
{
    #[Test]
    public function it_can_set_positions(): void
    {
        $layout = new Layout;
        $layout->top('test');
        $this->assertEquals('test', $layout->get('top'));

        $layout->bottom('test');
        $this->assertEquals('test', $layout->get('bottom'));

        $layout->topStart('test');
        $this->assertEquals('test', $layout->get('topStart'));

        $layout->topEnd('test');
        $this->assertEquals('test', $layout->get('topEnd'));

        $layout->bottomStart('test');
        $this->assertEquals('test', $layout->get('bottomStart'));

        $layout->bottomEnd('test');
        $this->assertEquals('test', $layout->get('bottomEnd'));

        $layout->top('test', 1);
        $this->assertEquals('test', $layout->get('top1'));

        $layout->bottom('test', 1);
        $this->assertEquals('test', $layout->get('bottom1'));

        $layout->topStart('test', 1);
        $this->assertEquals('test', $layout->get('top1Start'));

        $layout->bottomStart('test', 1);
        $this->assertEquals('test', $layout->get('bottom1Start'));

        $layout->topEnd('test', 1);
        $this->assertEquals('test', $layout->get('top1End'));

        $layout->bottomEnd('test', 1);
        $this->assertEquals('test', $layout->get('bottom1End'));
    }

    #[Test]
    public function it_can_be_used_in_builder(): void
    {
        $builder = resolve(Builder::class);
        $builder->layout(function (Layout $layout) {
            $layout->top('test');
            $layout->bottom('test');
            $layout->topStart('test');
            $layout->topEnd('test');
            $layout->bottomStart('test');
            $layout->bottomEnd('test');
            $layout->top('test', 1);
            $layout->bottom('test', 1);
            $layout->topStart('test', 1);
            $layout->bottomStart('test', 1);
            $layout->topEnd('test', 1);
            $layout->bottomEnd('test', 1);
        });

        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('top', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('bottom', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('topStart', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('topEnd', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('bottomStart', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('bottomEnd', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('top1', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('bottom1', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('top1Start', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('bottom1Start', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('top1End', $builder->getAttributes()['layout']);
        $this->assertArrayHasKey('bottom1End', $builder->getAttributes()['layout']);
    }

    #[Test]
    public function it_has_factory_method(): void
    {
        $layout = Layout::make();
        $this->assertInstanceOf(Layout::class, $layout);

        $builder = resolve(Builder::class);
        $builder->layout(Layout::make());

        $this->assertArrayHasKey('layout', $builder->getAttributes());
    }

    #[Test]
    public function it_can_be_macroable(): void
    {
        Layout::macro('test', fn () => 'test');

        $layout = new Layout;
        $this->assertEquals('test', $layout->test());
    }

    #[Test]
    public function it_can_accept_array(): void
    {
        $layout = new Layout(['top' => 'test']);
        $this->assertEquals('test', $layout->get('top'));
    }

    #[Test]
    public function it_can_accept_array_as_parameter(): void
    {
        $layout = Layout::make(['top' => 'test']);
        $this->assertEquals('test', $layout->get('top'));
    }

    #[Test]
    public function it_can_accept_array_as_parameter_in_builder(): void
    {
        $builder = resolve(Builder::class);
        $builder->layout(['top' => 'test']);

        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('top', $builder->getAttributes()['layout']);
    }

    #[Test]
    public function it_can_accept_callable_as_parameter_in_builder(): void
    {
        $builder = resolve(Builder::class);
        $builder->layout(fn (Layout $layout) => $layout->top('test'));

        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('top', $builder->getAttributes()['layout']);
    }

    #[Test]
    public function it_can_accept_js_selector_for_layout_content(): void
    {
        $builder = resolve(Builder::class);
        $builder->layout(fn (Layout $layout) => $layout->topView('#test'));

        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('top', $builder->getAttributes()['layout']);
        $this->assertEquals("function() { return $('#test').html(); }", $builder->getAttributes()['layout']['top']);

        $builder->layout(fn (Layout $layout) => $layout->bottomView('#test'));
        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('bottom', $builder->getAttributes()['layout']);
        $this->assertEquals("function() { return $('#test').html(); }", $builder->getAttributes()['layout']['bottom']);

        $builder->layout(fn (Layout $layout) => $layout->topStartView('#test'));
        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('topStart', $builder->getAttributes()['layout']);
        $this->assertEquals("function() { return $('#test').html(); }",
            $builder->getAttributes()['layout']['topStart']);

        $builder->layout(fn (Layout $layout) => $layout->topEndView('#test'));
        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('topEnd', $builder->getAttributes()['layout']);
        $this->assertEquals("function() { return $('#test').html(); }", $builder->getAttributes()['layout']['topEnd']);

        $builder->layout(fn (Layout $layout) => $layout->bottomStartView('#test'));
        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('bottomStart', $builder->getAttributes()['layout']);
        $this->assertEquals("function() { return $('#test').html(); }",
            $builder->getAttributes()['layout']['bottomStart']);

        $builder->layout(fn (Layout $layout) => $layout->bottomEndView('#test'));
        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('bottomEnd', $builder->getAttributes()['layout']);
        $this->assertEquals(
            "function() { return $('#test').html(); }",
            $builder->getAttributes()['layout']['bottomEnd']
        );
    }

    #[Test]
    public function it_can_accept_view_instance_or_string_for_layout_content(): void
    {
        $builder = resolve(Builder::class);

        $view = view('test-view');

        $builder->layout(fn (Layout $layout) => $layout
            ->addView(
                view: new TestView,
                layoutPosition: LayoutPosition::Top,
            )
            ->addView(
                view: new TestInlineView,
                layoutPosition: LayoutPosition::Bottom,
            )
            ->addView(
                view: $view,
                layoutPosition: LayoutPosition::TopStart,
                order: 1
            )
            ->addView(
                view: 'test-view',
                layoutPosition: LayoutPosition::BottomEnd,
                order: 2
            )
            ->addView(
                view: (new TestView)->render(),
                layoutPosition: LayoutPosition::Top,
                order: 3
            )
            ->addView(
                view: (new TestInlineView)->render(),
                layoutPosition: LayoutPosition::Bottom,
                order: 4
            )
        );

        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertCount(6, $builder->getAttributes()['layout']);

        $this->assertArrayHasKey('top', $builder->getAttributes()['layout']);
        $this->assertEquals(
            'function() { return '.json_encode($view->render()).'; }',
            $builder->getAttributes()['layout']['top']
        );

        $this->assertArrayHasKey('bottom', $builder->getAttributes()['layout']);
        $this->assertEquals(
            'function() { return '.json_encode('<p>Test Inline View</p>').'; }',
            $builder->getAttributes()['layout']['bottom']
        );

        $this->assertArrayHasKey('top1Start', $builder->getAttributes()['layout']);
        $this->assertEquals(
            'function() { return '.json_encode($view->render()).'; }',
            $builder->getAttributes()['layout']['top1Start']
        );

        $this->assertArrayHasKey('bottom2End', $builder->getAttributes()['layout']);
        $this->assertEquals(
            'function() { return '.json_encode($view->render()).'; }',
            $builder->getAttributes()['layout']['bottom2End']
        );

        $this->assertArrayHasKey('top3', $builder->getAttributes()['layout']);
        $this->assertEquals(
            'function() { return '.json_encode($view->render()).'; }',
            $builder->getAttributes()['layout']['top3']
        );

        $this->assertArrayHasKey('bottom4', $builder->getAttributes()['layout']);
        $this->assertEquals(
            'function() { return '.json_encode('<p>Test Inline View</p>').'; }',
            $builder->getAttributes()['layout']['bottom4']
        );
    }

    #[Test]
    public function it_throws_an_exception_if_the_view_does_not_exist_when_adding_view(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('View [non-existent-view] not found.');

        $builder = resolve(Builder::class);
        $builder->layout(fn (Layout $layout) => $layout
            ->addView(
                view: 'non-existent-view',
                layoutPosition: LayoutPosition::Top,
            )
            ->addView(
                view: view('non-existent-view'),
                layoutPosition: LayoutPosition::Bottom,
            ));
    }

    #[Test]
    public function it_can_accept_livewire_component_as_layout_content(): void
    {
        $builder = resolve(Builder::class);
        $builder->layout(fn (Layout $layout) => $layout
            ->addLivewire(TestLivewire::class, LayoutPosition::TopStart, 1)
            ->addLivewire(TestLivewire::class, LayoutPosition::BottomEnd, 2));

        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('top1Start', $builder->getAttributes()['layout']);
        $this->assertStringContainsString(
            'test livewire',
            $builder->getAttributes()['layout']['top1Start']
        );

        $this->assertArrayHasKey('layout', $builder->getAttributes());
        $this->assertArrayHasKey('bottom2End', $builder->getAttributes()['layout']);
        $this->assertStringContainsString(
            'test livewire',
            $builder->getAttributes()['layout']['bottom2End']
        );
    }

    #[Test]
    public function it_throws_an_exception_if_the_livewire_component_does_not_exist_when_adding_livewire_component(): void
    {
        $this->expectException(ComponentNotFoundException::class);
        $this->expectExceptionMessage('Unable to find component: [Yajra\DataTables\Html\Tests\TestComponents\TestView]');

        $builder = resolve(Builder::class);
        $builder->layout(fn (Layout $layout) => $layout
            ->addLivewire(TestView::class, LayoutPosition::Top)
            ->addLivewire(TestView::class, LayoutPosition::Bottom));
    }
}
