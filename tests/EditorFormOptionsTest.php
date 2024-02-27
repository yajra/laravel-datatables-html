<?php

namespace Yajra\DataTables\Html\Tests;

use PHPUnit\Framework\Attributes\Test;
use Yajra\DataTables\Html\Editor\FormOptions;

class EditorFormOptionsTest extends TestCase
{
    #[Test]
    public function it_has_setters()
    {
        $options = FormOptions::make();

        $this->assertInstanceOf(FormOptions::class, $options);

        $options->focus(1)
            ->message('message')
            ->onBackground('onBackground')
            ->onBlur('onBlur')
            ->onComplete('onComplete')
            ->onEsc('onEsc')
            ->onFieldError('onFieldError')
            ->onReturn('onReturn')
            ->submit('submit')
            ->title('title')
            ->drawType('drawType')
            ->formScope('scope')
            ->nest(false)
            ->buttons([])
            ->submitTrigger(1)
            ->submitHtml('submitHtml');

        $this->assertEquals(1, $options->focus);
        $this->assertEquals('message', $options->message);
        $this->assertEquals('onBackground', $options->onBackground);
        $this->assertEquals('onBlur', $options->onBlur);
        $this->assertEquals('onComplete', $options->onComplete);
        $this->assertEquals('onEsc', $options->onEsc);
        $this->assertEquals('onFieldError', $options->onFieldError);
        $this->assertEquals('onReturn', $options->onReturn);
        $this->assertEquals('submit', $options->submit);
        $this->assertEquals('title', $options->title);
        $this->assertEquals('drawType', $options->drawType);
        $this->assertEquals('scope', $options->scope);
        $this->assertEquals(false, $options->nest);
        $this->assertEquals([], $options->buttons);
        $this->assertEquals(1, $options->submitTrigger);
        $this->assertEquals('submitHtml', $options->submitHtml);
    }
}
