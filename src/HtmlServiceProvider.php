<?php

namespace Yajra\DataTables;

use Illuminate\Support\ServiceProvider;
use Collective\Html\HtmlServiceProvider as CollectiveHtml;

class HtmlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'datatables');

        if ($this->app->runningInConsole()) {
            $this->publishAssets();
        }
    }

    /**
     * Publish datatables assets.
     */
    protected function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/resources/views'             => base_path('/resources/views/vendor/datatables'),
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
        $this->mergeConfigFrom(__DIR__ . '/resources/config/config.php', 'datatables-html');

        $this->app->register(CollectiveHtml::class);

        $this->app->bind('datatables.html', function () {
            return $this->app->make(Html\Builder::class);
        });
    }
}
