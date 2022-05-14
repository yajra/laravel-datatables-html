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
            ->fields([
                Text::make('name'),
            ])
            ->ajax('/test')
            ->template('#template');

        $this->assertCount(1, $editor->fields);
        $this->assertEquals('/test', $editor->ajax);
        $this->assertEquals('#template', $editor->template);
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
    public function it_has_authorizations()
    {
        $editor = Editor::makeIf(true, 'editor');
        $this->assertInstanceOf(Editor::class, $editor);
        $this->assertEquals(true, $editor->isAuthorized());

        $editor = Editor::makeIf(false, 'editor');
        $this->assertInstanceOf(Editor::class, $editor);
        $this->assertEquals(false, $editor->isAuthorized());

        $editor = Editor::makeIfCan('ability', 'editor');
        $this->assertInstanceOf(Editor::class, $editor);
        $this->assertEquals(false, $editor->isAuthorized());

        $editor = Editor::makeIfCannot('ability', 'editor');
        $this->assertInstanceOf(Editor::class, $editor);
        $this->assertEquals(false, $editor->isAuthorized());
    }

    /**
     * @param  string  $instance
     * @return \Yajra\DataTables\Html\Editor\Editor
     */
    protected function getEditor(string $instance = 'editor'): Editor
    {
        return Editor::make($instance);
    }
}