<?php

namespace Yajra\Datatables;

use Collective\Html\HtmlServiceProvider as CollectiveHtml;
use Illuminate\Support\ServiceProvider;

/**
 * Class HtmlServiceProvider.
 *
 * @package Yajra\Datatables
 * @author  Arjay Angeles <aqangeles@gmail.com>
 */
class HtmlServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'datatables');
        $this->mergeConfigFrom(__DIR__.'/resources/config/config.php', 'datatables-html');

        $this->publishAssets();
    }

    /**
     * Publish datatables assets.
     */
    protected function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/resources/views' => base_path('/resources/views/vendor/datatables'),
            __DIR__ . '/resources/config/config.php' => config_path('datatables-html.php'),
        ], 'datatables-html');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(CollectiveHtml::class);

        $this->app->bind('datatables.html', function () {
            return $this->app->make(Html\Builder::class);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['datatables.html'];
    }
}
