<?php

namespace Yajra\DataTables\Html\Tests;

use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Tests\Models\User;

class FieldTest extends TestCase
{
    /** @test */
    public function it_can_create_a_field()
    {
        $field = Fields\Field::make('name');

        $this->assertInstanceOf(Fields\Field::class, $field);
        $this->assertEquals('Name', $field->label);
        $this->assertEquals('name', $field->name);
        $this->assertEquals('text', $field->getType());
    }

    /** @test */
    public function it_can_set_properties()
    {
        $field = Fields\Field::make('name');

        $field->label('Test');
        $field->name('Test');
        $field->data('Test');
        $field->type('Test');

        $this->assertEquals('Test', $field->label);
        $this->assertEquals('Test', $field->name);
        $this->assertEquals('Test', $field->data);
        $this->assertEquals('Test', $field->getType());
    }

    /** @test */
    public function it_can_create_belongs_to_field()
    {
        $field = Fields\BelongsTo::model(User::class, 'name');
        $this->assertInstanceOf(Fields\BelongsTo::class, $field);
        $this->assertEquals('select', $field->getType());
        $this->assertEquals('user_id', $field->name);
        $this->assertEquals('User', $field->label);
    }

    /** @test */
    public function it_can_create_boolean_field()
    {
        $field = Fields\Boolean::make('name');
        $this->assertInstanceOf(Fields\Boolean::class, $field);
        $this->assertEquals('checkbox', $field->getType());
        $this->assertEquals('name', $field->name);
        $this->assertEquals('Name', $field->label);
        $this->assertEquals(',', $field->separator);
        $this->assertEquals([['label' => '', 'value' => 1]], $field->options);
    }

    /** @test */
    public function it_can_create_date_field()
    {
        $field = Fields\Date::make('name');
        $this->assertInstanceOf(Fields\Date::class, $field);
        $this->assertEquals('datetime', $field->getType());
        $this->assertEquals('name', $field->name);
        $this->assertEquals('Name', $field->label);
        $this->assertEquals('YYYY-MM-DD', $field->format);
    }

    /** @test */
    public function it_can_create_datetime_field()
    {
        $field = Fields\DateTime::make('name');
        $this->assertInstanceOf(Fields\DateTime::class, $field);
        $this->assertEquals('datetime', $field->getType());
        $this->assertEquals('name', $field->name);
        $this->assertEquals('Name', $field->label);
        $this->assertEquals('YYYY-MM-DD hh:mm a', $field->format);

        $field->military();
        $this->assertEquals('YYYY-MM-DD HH:mm', $field->format);

        $min = now();
        $field->minDate($min);
        $date = $min->format('Y-m-d');
        $this->assertEquals("new Date('$date')", $field->opts['minDate']);

        $max = now();
        $field->maxDate($max);
        $date = $max->format('Y-m-d');
        $this->assertEquals("new Date('$date')", $field->opts['maxDate']);

        $field->showWeekNumber(false);
        $this->assertEquals(false, $field->opts['showWeekNumber']);

        $field->disableDays([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $field->opts['disableDays']);

        $field->minutesIncrement(2);
        $this->assertEquals(2, $field->opts['minutesIncrement']);

        $field->secondsIncrement(2);
        $this->assertEquals(2, $field->opts['secondsIncrement']);

        $field->hoursAvailable([1, 2]);
        $this->assertEquals([1, 2], $field->opts['hoursAvailable']);

        $field->minutesAvailable([1, 2]);
        $this->assertEquals([1, 2], $field->opts['minutesAvailable']);
    }

    /** @test */
    public function it_can_create_file_field()
    {
        $field = Fields\File::make('name');
        $this->assertInstanceOf(Fields\File::class, $field);
        $this->assertEquals('upload', $field->getType());
        // TODO: add more file field test
    }

    /** @test */
    public function it_can_create_hidden_field()
    {
        $field = Fields\Hidden::make('name');
        $this->assertInstanceOf(Fields\Hidden::class, $field);
        $this->assertEquals('hidden', $field->getType());
    }

    /** @test */
    public function it_can_create_image_field()
    {
        $field = Fields\Image::make('name');
        $this->assertInstanceOf(Fields\Image::class, $field);
        $this->assertEquals('upload', $field->getType());
    }

    /** @test */
    public function it_can_create_number_field()
    {
        $field = Fields\Number::make('name');
        $this->assertInstanceOf(Fields\Number::class, $field);
        $this->assertEquals('text', $field->getType());
    }

    /** @test */
    public function it_can_create_password_field()
    {
        $field = Fields\Password::make('name');
        $this->assertInstanceOf(Fields\Password::class, $field);
        $this->assertEquals('password', $field->getType());
    }

    /** @test */
    public function it_can_create_radio_field()
    {
        $field = Fields\Radio::make('name');
        $this->assertInstanceOf(Fields\Radio::class, $field);
        $this->assertEquals('radio', $field->getType());
    }

    /** @test */
    public function it_can_create_read_only_field()
    {
        $field = Fields\ReadOnlyField::make('name');
        $this->assertInstanceOf(Fields\ReadOnlyField::class, $field);
        $this->assertEquals('readonly', $field->getType());
    }

    /** @test */
    public function it_can_create_select_field()
    {
        $field = Fields\Select::make('name');
        $this->assertInstanceOf(Fields\Select::class, $field);
        $this->assertEquals('select', $field->getType());
    }

    /** @test */
    public function it_can_create_select2_field()
    {
        $field = Fields\Select2::make('name')
                               ->allowClear()
                               ->optsPlaceholder('Test')
                               ->modelOptions(User::class, 'name')
                               ->ajax('/url');

        $this->assertInstanceOf(Fields\Select2::class, $field);
        $this->assertEquals('select2', $field->getType());
        $this->assertEquals('/url', $field->opts['ajax']['url']);
        $this->assertEquals('Test', $field->opts['placeholder']['text']);
        $this->assertEquals('id', $field->opts['placeholder']['id']);
        $this->assertCount(20, $field->options);
    }

    /** @test */
    public function it_can_create_text_field()
    {
        $field = Fields\Text::make('name')
                            ->attr('style', 'display: none;');

        $this->assertInstanceOf(Fields\Text::class, $field);
        $this->assertEquals('text', $field->getType());
        $this->assertEquals('display: none;', $field->attr['style']);
    }

    /** @test */
    public function it_can_create_textarea_field()
    {
        $field = Fields\TextArea::make('name');
        $this->assertInstanceOf(Fields\TextArea::class, $field);
        $this->assertEquals('textarea', $field->getType());

        $field->rows(5);
        $this->assertEquals('5', $field->attr['rows']);

        $field->cols(5);
        $this->assertEquals('5', $field->attr['cols']);
    }

    /** @test */
    public function it_can_create_time_field()
    {
        $field = Fields\Time::make('name');
        $this->assertInstanceOf(Fields\Time::class, $field);
        $this->assertEquals('datetime', $field->getType());
        $this->assertEquals('name', $field->name);
        $this->assertEquals('Name', $field->label);
        $this->assertEquals('hh:mm a', $field->format);
    }

    /** @test */
    public function it_has_authorizations()
    {
        $field = Fields\Text::makeIf(true, 'name');
        $this->assertEquals([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ], $field->toArray());

        $field = Fields\Text::makeIf(false, 'name');
        $this->assertEquals([], $field->toArray());
    }

    /** @test */
    public function it_can_be_serialized()
    {
        $field = Fields\Text::make('name')->data('user.name');

        $this->assertEquals([
            'name' => 'name',
            'data' => 'user.name',
            'label' => 'Name',
            'type' => 'text',
        ], $field->toArray());

        $this->assertEquals('{"name":"name","label":"Name","type":"text","data":"user.name"}', $field->toJson());
    }
}
