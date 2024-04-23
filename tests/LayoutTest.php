<?php

namespace Yajra\DataTables\Html\Tests;

use PHPUnit\Framework\Attributes\Test;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Layout;

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

        $layout->top('test', 1, 'Start');
        $this->assertEquals('test', $layout->get('top1Start'));

        $layout->bottom('test', 1, 'Start');
        $this->assertEquals('test', $layout->get('bottom1Start'));

        $layout->top('test', 1, 'End');
        $this->assertEquals('test', $layout->get('top1End'));

        $layout->bottom('test', 1, 'End');
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
            $layout->top('test', 1, 'Start');
            $layout->bottom('test', 1, 'Start');
            $layout->top('test', 1, 'End');
            $layout->bottom('test', 1, 'End');
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
}
