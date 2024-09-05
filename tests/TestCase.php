<?php

namespace Tests;

use Orchestra\Testbench\Dusk\TestCase as DuskTestCase;
use Yuanchin\YuanxinUi\YuanxinUi;
use Yuanchin\YuanxinUi\YuanxinUiServiceProvider;

abstract class TestCase extends DuskTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            YuanxinUiServiceProvider::class
        ];
    }
    protected function getPackageAliases($app)
    {
        return [
            'YuanxinUi' => YuanxinUi::class
        ];
    }
}
