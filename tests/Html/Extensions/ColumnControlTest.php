<?php

namespace Yajra\DataTables\Html\Tests\Html\Extensions;

use PHPUnit\Framework\Attributes\Test;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Tests\TestCase;

class ColumnControlTest extends TestCase
{
    #[Test]
    public function it_can_set_column_control_options_on_builder()
    {
        $builder = $this->getHtmlBuilder();
        $options = [
            'target' => 0,
            'content' => ['search', 'order'],
        ];

        $result = $builder->columnControl($options);

        $this->assertInstanceOf(Builder::class, $result);
        $this->assertEquals($options, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_set_column_control_options_on_column()
    {
        $column = Column::make('name');
        $options = [
            'target' => 'thead:0',
            'content' => ['search'],
        ];

        $result = $column->columnControl($options);

        $this->assertInstanceOf(Column::class, $result);
        $this->assertEquals($options, $column->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_header()
    {
        $builder = $this->getHtmlBuilder();
        $content = ['search', 'order'];
        $target = 1;

        $result = $builder->columnControlHeader($content, $target);

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 'thead:1', 'content' => $content],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_header_with_default_target()
    {
        $builder = $this->getHtmlBuilder();
        $content = ['search'];

        $result = $builder->columnControlHeader($content);

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 'thead:0', 'content' => $content],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_footer()
    {
        $builder = $this->getHtmlBuilder();
        $content = ['search', 'order'];
        $target = 2;

        $result = $builder->columnControlFooter($content, $target);

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 'tfoot:2', 'content' => $content],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_footer_with_default_target()
    {
        $builder = $this->getHtmlBuilder();
        $content = ['order'];

        $result = $builder->columnControlFooter($content);

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 'tfoot:0', 'content' => $content],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_footer_search()
    {
        $builder = $this->getHtmlBuilder();

        $result = $builder->columnControlFooterSearch();

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 'tfoot', 'content' => [['search']]],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_footer_search_with_custom_content()
    {
        $builder = $this->getHtmlBuilder();
        $content = ['customSearch'];

        $result = $builder->columnControlFooterSearch($content);

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 'tfoot', 'content' => [['customSearch']]],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_search_dropdown()
    {
        $builder = $this->getHtmlBuilder();
        $target = 1;

        $result = $builder->columnControlSearchDropdown($target);

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 1, 'content' => ['order', 'searchDropdown']],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_search_dropdown_with_default_target()
    {
        $builder = $this->getHtmlBuilder();

        $result = $builder->columnControlSearchDropdown();

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 0, 'content' => ['order', 'searchDropdown']],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_search()
    {
        $builder = $this->getHtmlBuilder();
        $content = ['customSearch'];
        $target = 2;

        $result = $builder->columnControlSearch($content, $target);

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 2, 'content' => $content],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_search_with_defaults()
    {
        $builder = $this->getHtmlBuilder();

        $result = $builder->columnControlSearch();

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 1, 'content' => ['search']],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_spacer()
    {
        $builder = $this->getHtmlBuilder();
        $target = 3;

        $result = $builder->columnControlSpacer($target);

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 3, 'content' => [['extend' => 'spacer']]],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_spacer_with_default_target()
    {
        $builder = $this->getHtmlBuilder();

        $result = $builder->columnControlSpacer();

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 1, 'content' => [['extend' => 'spacer']]],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_title_with_string()
    {
        $builder = $this->getHtmlBuilder();
        $title = 'My Title';
        $target = 2;

        $result = $builder->columnControlTitle($title, $target);

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 2, 'content' => [['extend' => 'title', 'text' => 'My Title']]],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_title_with_array()
    {
        $builder = $this->getHtmlBuilder();
        $title = ['text' => 'Custom Title', 'className' => 'custom-class'];
        $target = 3;

        $result = $builder->columnControlTitle($title, $target);

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 3, 'content' => [['extend' => 'title', 'text' => 'Custom Title', 'className' => 'custom-class']]],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_can_add_column_control_title_with_defaults()
    {
        $builder = $this->getHtmlBuilder();

        $result = $builder->columnControlTitle();

        $this->assertInstanceOf(Builder::class, $result);
        $expected = [
            ['target' => 1, 'content' => [['extend' => 'title', 'text' => null]]],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_merges_content_for_same_target()
    {
        $builder = $this->getHtmlBuilder();

        // Add first control for target 1
        $builder->columnControlSearch(['search'], 1);
        // Add second control for target 1
        $builder->columnControlSpacer(1);

        $expected = [
            ['target' => 1, 'content' => ['search', ['extend' => 'spacer']]],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_removes_duplicate_content_when_merging()
    {
        $builder = $this->getHtmlBuilder();

        // Add same content twice for the same target
        $builder->columnControlSearch(['search', 'order'], 1);

        // Use reflection to access the protected method for testing
        $reflection = new \ReflectionClass($builder);
        $method = $reflection->getMethod('addColumnControl');
        $method->setAccessible(true);
        $method->invoke($builder, 1, ['search', 'filter']);

        $attributes = $builder->getAttributes();
        $content = $attributes['columnControl'][0]['content'];

        // Should have unique values only
        $this->assertCount(3, $content);
        $this->assertContains('search', $content);
        $this->assertContains('order', $content);
        $this->assertContains('filter', $content);
    }

    #[Test]
    public function it_can_chain_multiple_column_control_methods()
    {
        $builder = $this->getHtmlBuilder();

        $result = $builder
            ->columnControlHeader(['search'])
            ->columnControlFooter(['order'])
            ->columnControlSpacer(2)
            ->columnControlTitle('Test Title', 3);

        $this->assertInstanceOf(Builder::class, $result);

        $expected = [
            ['target' => 'thead:0', 'content' => ['search']],
            ['target' => 'tfoot:0', 'content' => ['order']],
            ['target' => 2, 'content' => [['extend' => 'spacer']]],
            ['target' => 3, 'content' => [['extend' => 'title', 'text' => 'Test Title']]],
        ];
        $this->assertEquals($expected, $builder->getAttributes()['columnControl']);
    }

    #[Test]
    public function it_works_with_column_instances()
    {
        $column = Column::make('name')
            ->columnControlHeader(['search'])
            ->columnControlSpacer()
            ->columnControlTitle('Column Title');

        $attributes = $column->getAttributes();

        // We expect separate entries, not merged ones for different targets
        $this->assertCount(2, $attributes['columnControl']);

        // Check first control (header)
        $this->assertEquals('thead:0', $attributes['columnControl'][0]['target']);
        $this->assertEquals(['search'], $attributes['columnControl'][0]['content']);

        // Check second control (spacer + title merged for target 1)
        $this->assertEquals(1, $attributes['columnControl'][1]['target']);
        $this->assertContains(['extend' => 'spacer'], $attributes['columnControl'][1]['content']);
        $this->assertContains(['extend' => 'title', 'text' => 'Column Title'], $attributes['columnControl'][1]['content']);
    }
}
