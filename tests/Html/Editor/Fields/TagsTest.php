<?php

namespace Yajra\DataTables\Html\Tests\Html\Editor\Fields;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Yajra\DataTables\Html\Editor\Fields\Tags;

class TagsTest extends TestCase
{
    #[Test]
    public function it_can_set_tags_ajax(): void
    {
        $field = new Tags;
        $field->ajax('/tags');

        $this->assertSame('/tags', $field->toArray()['ajax']);
    }

    #[Test]
    public function it_can_set_tags_display(): void
    {
        $field = new Tags;
        $field->display('display');

        $this->assertSame('display', $field->toArray()['display']);
    }

    #[Test]
    public function it_can_set_tags_escape_label_html(): void
    {
        $field = new Tags;
        $field->escapeLabelHtml(true);

        $this->assertTrue($field->toArray()['escapeLabelHtml']);
    }

    #[Test]
    public function it_can_set_tags_i18n(): void
    {
        $field = new Tags;
        $field->i18n([
            'addButton' => 'Add',
            'inputPlaceholder' => 'Input',
            'noResults' => 'No Results',
            'title' => 'Title',
            'placeholder' => 'Placeholder',
        ]);

        $this->assertSame('Add', $field->toArray()['i18n']['addButton']);
        $this->assertSame('Input', $field->toArray()['i18n']['inputPlaceholder']);
        $this->assertSame('No Results', $field->toArray()['i18n']['noResults']);
        $this->assertSame('Title', $field->toArray()['i18n']['title']);
        $this->assertSame('Placeholder', $field->toArray()['i18n']['placeholder']);

        $field->addButton('Add Button')
            ->inputPlaceholder('Input Placeholder')
            ->noResults('No Results X')
            ->title('Title X')
            ->placeholder('Placeholder X');

        $this->assertSame('Add Button', $field->toArray()['i18n']['addButton']);
        $this->assertSame('Input Placeholder', $field->toArray()['i18n']['inputPlaceholder']);
        $this->assertSame('No Results X', $field->toArray()['i18n']['noResults']);
        $this->assertSame('Title X', $field->toArray()['i18n']['title']);
        $this->assertSame('Placeholder X', $field->toArray()['i18n']['placeholder']);
    }

    #[Test]
    public function it_can_set_tags_type(): void
    {
        $field = new Tags;

        $this->assertSame('tags', $field->toArray()['type']);
    }

    #[Test]
    public function it_can_set_tags_limit(): void
    {
        $field = new Tags;
        $field->limit(2);

        $this->assertSame(2, $field->toArray()['limit']);
    }

    #[Test]
    public function it_can_set_tags_multiple(): void
    {
        $field = new Tags;
        $field->multiple();

        $this->assertTrue($field->toArray()['multiple']);
    }

    #[Test]
    public function it_can_set_tags_options(): void
    {
        $field = new Tags;
        $field->options(['tag1', 'tag2']);

        $this->assertSame(['tag1', 'tag2'], $field->toArray()['options']);

        $field->options([
            ['value' => 'tag1', 'label' => 'Tag 1'],
            ['value' => 'tag2', 'label' => 'Tag 2'],
        ]);

        $this->assertSame([
            ['value' => 'tag1', 'label' => 'Tag 1'],
            ['value' => 'tag2', 'label' => 'Tag 2'],
        ], $field->toArray()['options']);
    }

    #[Test]
    public function it_can_set_tags_separator(): void
    {
        $field = new Tags;
        $field->separator(',');

        $this->assertSame(',', $field->toArray()['separator']);
    }

    #[Test]
    public function it_can_set_tags_unique(): void
    {
        $field = new Tags;
        $field->unique();

        $this->assertTrue($field->toArray()['unique']);
    }
}
