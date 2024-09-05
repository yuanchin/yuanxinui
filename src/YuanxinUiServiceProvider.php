<?php

namespace Yuanchin\YuanxinUi;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class YuanxinUiServiceProvider extends ServiceProvider
{
    /**
     * The path of each file.
     *
     * @var array
     */
    protected array $path = [
        'config' => __DIR__ . '/../config/yuanxinui.php',
        'routes' => __DIR__ . '/../routes/web.php',
        'views' => __DIR__ . '/Components/*/views',
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAliases();

        $this->registerYuanxinUi();

        $this->registerServices();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom($this->path['config'], 'yuanxinui');

        $this->loadRoutesFrom($this->path['routes']);

        $this->bootViews();

        $this->bootComponents();

        $this->bootServices();

        // publishes
        $this->publishes([$this->path['config'] => config_path('yuanxinui.php')], 'yuanxinui.config');
    }

    /**
     * Bind some aliases.
     *
     * @return void
     */
    protected function registerAliases()
    {
        $this->app->alias('yuanchin.yuanxinui', YuanxinUiManager::class);
    }

    /**
     * Register the yuanxinui.
     *
     * @return void
     */
    protected function registerYuanxinUi()
    {
        $this->app->singleton('yuanchin.yuanxinui', function ($app) {
            return new YuanxinUiManager(
                $app['config']['yuanxinui']
            );
        });
    }

    /**
     * Register a class-based YuanxinUi component alias directive.
     *
     * @return void
     */
    protected function bootComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function ($blade) {
            $prefix = $this->app['config']['yuanxinui.prefix'];
            $components = $this->app['config']['yuanxinui.components'];

            foreach ($components as $alias => $class) {
                $blade->component($class, $alias, $prefix);
            }

            $blade->anonymousComponentPath(
                __DIR__ . '/Components/Icon/views',
                'yuanxinui-icon'
            );
        });
    }

    /**
     * Register a YuanxinUi view file namespace.
     *
     * @return void
     */
    protected function bootViews()
    {
        $views = collect(
            glob($this->path['views'])
        );

        $views->each(function (string $path) {
            $name = str()->kebab(
                basename(dirname($path))
            );

            $this->loadViewsFrom($path, "yuanxinui-{$name}");
        });
    }

    /**
     * Get the namespaces of all service classes.
     *
     * @return array<string>
     */
    protected function getServices()
    {
        return [
            Services\FrontendAssets\FrontendAssets::class
        ];
    }

    /**
     * Register all service classes.
     *
     * @return void
     */
    protected function registerServices()
    {
        foreach ($this->getServices() as $service) {
            app($service)->register();
        }
    }

    /**
     * Boot all service classes.
     *
     * @return void
     */
    protected function bootServices()
    {
        foreach ($this->getServices() as $service) {
            app($service)->boot();
        }
    }
}
