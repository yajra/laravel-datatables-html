<?php

namespace Yajra\DataTables\Html\Tests\Html\Editor\Fields;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Yajra\DataTables\Html\Editor\Fields\Options;
use Yajra\DataTables\Html\Tests\Models\User;
use Yajra\DataTables\Html\Tests\TestCase;

class FieldOptionsTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_has_true_false()
    {
        $options = Options::trueFalse();

        $this->assertEquals([
            ['label' => __('True'), 'value' => 1],
            ['label' => __('False'), 'value' => 0],
        ], $options->toArray());
    }

    #[Test]
    public function it_has_yes_no()
    {
        $options = Options::yesNo();

        $this->assertEquals([
            ['label' => __('Yes'), 'value' => 1],
            ['label' => __('No'), 'value' => 0],
        ], $options->toArray());
    }

    #[Test]
    public function it_can_append_and_prepend()
    {
        $options = Options::yesNo();

        $this->assertEquals([
            ['label' => __('Yes'), 'value' => 1],
            ['label' => __('No'), 'value' => 0],
        ], $options->toArray());

        $options->append(__('Maybe'), 2);
        $this->assertEquals([
            ['label' => __('Yes'), 'value' => 1],
            ['label' => __('No'), 'value' => 0],
            ['label' => __('Maybe'), 'value' => 2],
        ], $options->toArray());

        $options->prepend(__('IDK'), 3);
        $this->assertEquals([
            ['label' => __('IDK'), 'value' => 3],
            ['label' => __('Yes'), 'value' => 1],
            ['label' => __('No'), 'value' => 0],
            ['label' => __('Maybe'), 'value' => 2],
        ], $options->toArray());
    }

    #[Test]
    public function it_can_get_options_from_table()
    {
        $options = Options::table('users', 'name');
        $this->assertCount(20, $options);
    }

    #[Test]
    public function it_can_get_options_from_query()
    {
        $options = Options::table(DB::table('users')->where('id', 1), 'name');
        $this->assertCount(1, $options);
    }

    #[Test]
    public function it_can_get_options_from_model()
    {
        $options = Options::model(User::class, 'name');
        $this->assertCount(20, $options);
    }

    #[Test]
    public function it_can_get_options_from_model_builder()
    {
        $options = Options::model(User::query()->whereKey(1), 'name');
        $this->assertCount(1, $options);
    }
}
