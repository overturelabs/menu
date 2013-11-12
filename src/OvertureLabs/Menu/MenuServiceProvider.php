<?php namespace OvertureLabs\Menu;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
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
        $this->package('overturelabs/menu');

        /**
         * Register Laravel Facade
         */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Menu', 'OvertureLabs\Menu\Facades\Menu');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['menu'] = $this->app->share(function($app)
        {
            return new MenuBuilder($app['html'], $app['url']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
