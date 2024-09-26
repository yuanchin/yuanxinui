<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Laravel\Dusk\Browser;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\Dusk\TestCase;
use Yuanchin\YuanxinUi\YuanxinUi;
use Yuanchin\YuanxinUi\YuanxinUiServiceProvider;

use function Livewire\trigger;

class BrowserTestCase extends TestCase
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        Browser::$waitSeconds = 30;

        parent::setUp();

        trigger('browser.testCase.setUp', $this);
    }

    public static function tweakApplicationHook()
    {
        return function () {
            //
        };
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            YuanxinUiServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'YuanxinUi' => YuanxinUi::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        tap($app['session'], function ($session) {
            $session->put('_token', str()->random(40));
        });

        tap($app['config'], function ($config) {
            $config->set('app.env', 'testing');

            $config->set('app.debug', true);

            $config->set('view.paths', [__DIR__ . '/views', resource_path('views')]);

            $config->set('app.key', 'base64:TqRglGMM06wT2hG5AT+yZ4S+DyMVLpE10Kt08rEbSjg=');

            $config->set('database.default', 'testbench');

            $config->set('database.connections.testbench', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]);
        });
    }
}
