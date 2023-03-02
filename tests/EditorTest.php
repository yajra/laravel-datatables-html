<?php

namespace Yajra\DataTables\Html\Tests;

use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields\Text;

class EditorTest extends TestCase
{
    /** @test */
    public function it_can_create_an_editor()
    {
        $editor = $this->getEditor();

        $this->assertInstanceOf(Editor::class, $editor);
        $this->assertEquals('editor', $editor->instance);
        $this->assertEmpty($editor->fields);
        $this->assertEmpty($editor->ajax);
        $this->assertEmpty($editor->template);

        $editor
            ->idSrc()
            ->fields([
                Text::make('name'),
            ])
            ->ajax('/test')
            ->template('#template');

        $this->assertCount(1, $editor->fields);
        $this->assertEquals('/test', $editor->ajax);
        $this->assertEquals('#template', $editor->template);
        $this->assertEquals('DT_RowId', $editor->idSrc);
    }

    /**
     * @param  string  $instance
     * @return \Yajra\DataTables\Html\Editor\Editor
     */
    protected function getEditor(string $instance = 'editor'): Editor
    {
        return Editor::make($instance);
    }

    /** @test */
    public function it_can_have_events()
    {
        $editor = $this->getEditor();

        $editor->onPostSubmit('post');
        $editor->onDisplayOrder('display');

        $this->assertCount(2, $editor->events);

        $event = [
            'event' => 'postSubmit',
            'script' => 'post',
        ];

        $this->assertEquals($event, $editor->events[0]);
    }

    /** @test */
    public function it_can_show_hide_fields()
    {
        $editor = $this->getEditor();

        $editor->hiddenOnCreate(['name']);
        $editor->hiddenOnEdit(['email']);

        $this->assertCount(2, $editor->events);

        $this->assertEquals('preOpen', $editor->events[0]['event']);
        $this->assertStringContainsString("action === 'create'", $editor->events[0]['script']);
        $this->assertStringContainsString("this.hide('name')", $editor->events[0]['script']);

        $this->assertEquals('preOpen', $editor->events[1]['event']);
        $this->assertStringContainsString("action === 'edit'", $editor->events[1]['script']);
        $this->assertStringContainsString("this.hide('email')", $editor->events[1]['script']);
    }

    /** @test */
    public function it_has_authorizations()
    {
        $editor = Editor::makeIf(true, 'editor')
                        ->fields([
                            Text::make('name'),
                        ]);
        $this->assertInstanceOf(Editor::class, $editor);
        $this->assertEquals(true, $editor->isAuthorized());
        $this->assertEquals([
            'instance' => 'editor',
            'fields' => [
                Text::make('name')->toArray(),
            ],
        ], $editor->toArray());

        $editor = Editor::makeIf(false, 'editor')
                        ->fields([
                            Text::make('name'),
                        ]);
        $this->assertInstanceOf(Editor::class, $editor);
        $this->assertEquals(false, $editor->isAuthorized());
        $this->assertCount(1, $editor->fields);
        $this->assertEquals([], $editor->toArray());

        $editor = Editor::makeIfCan('ability', 'editor');
        $this->assertInstanceOf(Editor::class, $editor);
        $this->assertEquals(false, $editor->isAuthorized());
        $this->assertEquals([], $editor->toArray());

        $editor = Editor::makeIfCannot('ability', 'editor');
        $this->assertInstanceOf(Editor::class, $editor);
        $this->assertEquals(false, $editor->isAuthorized());
        $this->assertEquals([], $editor->toArray());
    }

    /** @test */
    public function it_can_be_serialized_to_array()
    {
        $editor = Editor::make()
                        ->ajax('')
                        ->fields([
                            Text::make('name'),
                        ]);

        $this->assertEquals([
            'instance' => 'editor',
            'ajax' => '',
            'fields' => [
                Text::make('name')->toArray(),
            ],
        ], $editor->toArray());
    }

    /** @test */
    public function it_can_be_serialized_to_json_string()
    {
        $editor = Editor::make()
                        ->ajax('')
                        ->fields([
                            Text::make('name'),
                        ]);

        $expected = '{"instance":"editor","ajax":"","fields":[{"name":"name","label":"Name","type":"text"}]}';
        $this->assertEquals($expected, $editor->toJson());
    }

    /** @test */
    public function it_has_form_options()
    {
        $editor = Editor::make()
                        ->formOptions([
                            'main' => [
                                'esc' => true,
                            ],
                        ]);

        $this->assertEquals([
            'main' => [
                'esc' => true,
            ],
        ], $editor->formOptions);

        $editor->formOptionsMain(['esc' => true]);
        $this->assertEquals(['esc' => true], $editor->formOptions['main']);

        $editor->formOptionsBubble(['esc' => true]);
        $this->assertEquals(['esc' => true], $editor->formOptions['bubble']);

        $editor->formOptionsInline(['esc' => true]);
        $this->assertEquals(['esc' => true], $editor->formOptions['inline']);
    }

    /** @test */
    public function it_has_display_constants()
    {
        $editor = Editor::make()->display(Editor::DISPLAY_BOOTSTRAP);
        $this->assertEquals('bootstrap', $editor->display);

        $editor->display(Editor::DISPLAY_ENVELOPE);
        $this->assertEquals('envelope', $editor->display);

        $editor->display(Editor::DISPLAY_FOUNDATION);
        $this->assertEquals('foundation', $editor->display);

        $editor->display(Editor::DISPLAY_JQUERYUI);
        $this->assertEquals('jqueryui', $editor->display);

        $editor->display(Editor::DISPLAY_LIGHTBOX);
        $this->assertEquals('lightbox', $editor->display);
    }

    /** @test */
    public function it_has_scripts()
    {
        $editor = Editor::make()->scripts('fn');
        $this->assertEquals('fn', $editor->scripts);
    }
}
