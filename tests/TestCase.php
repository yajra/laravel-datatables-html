<?php

namespace Yajra\DataTables\Html\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Yajra\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Tests\Models\Role;
use Yajra\DataTables\Html\Tests\Models\User;
use Yajra\DataTables\HtmlServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('app.key', 'base64:6pASQ5U2UYo+w6noM9hwOPeHJ5vGP+BNruyMtRA8FWY=');

        $this->migrateDatabase();
        $this->seedDatabase();
        $this->setupViewAndBladeDirectory();
    }

    protected function migrateDatabase(): void
    {
        /** @var \Illuminate\Database\Schema\Builder $schemaBuilder */
        $schemaBuilder = $this->app['db']->connection()->getSchemaBuilder();
        if (! $schemaBuilder->hasTable('users')) {
            $schemaBuilder->create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->string('user_type')->nullable();
                $table->unsignedInteger('user_id')->nullable();
                $table->timestamps();
            });
        }
        if (! $schemaBuilder->hasTable('posts')) {
            $schemaBuilder->create('posts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->unsignedInteger('user_id');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        if (! $schemaBuilder->hasTable('roles')) {
            $schemaBuilder->create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('role');
                $table->timestamps();
            });
        }
        if (! $schemaBuilder->hasTable('role_user')) {
            $schemaBuilder->create('role_user', function (Blueprint $table) {
                $table->unsignedInteger('role_id');
                $table->unsignedInteger('user_id');
                $table->timestamps();
            });
        }
    }

    protected function seedDatabase(): void
    {
        $adminRole = Role::create(['role' => 'Administrator']);
        $userRole = Role::create(['role' => 'User']);

        collect(range(1, 20))->each(function ($i) use ($userRole) {
            /** @var User $user */
            $user = User::query()->create([
                'name' => 'Record-'.$i,
                'email' => 'Email-'.$i.'@example.com',
            ]);

            collect(range(1, 3))->each(function ($i) use ($user) {
                $user->posts()->create([
                    'title' => "User-{$user->id} Post-{$i}",
                ]);
            });

            if ($i % 2) {
                $user->roles()->attach(Role::all());
            } else {
                $user->roles()->attach($userRole);
            }
        });
    }

    /**
     * Set up the environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('app.debug', true);
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            DataTablesServiceProvider::class,
            HtmlServiceProvider::class,
        ];
    }

    protected function getHtmlBuilder(): Builder
    {
        return app(Builder::class);
    }

    protected function setupViewAndBladeDirectory(): void
    {
        View::addLocation(__DIR__.'/TestComponents');
        Blade::componentNamespace('Yajra\\DataTables\\Html\\Tests\\TestComponents', 'test');
    }
}
