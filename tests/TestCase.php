<?php

namespace Tests;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Yuanchin\YuanxinUi\YuanxinUi;
use Yuanchin\YuanxinUi\YuanxinUiServiceProvider;

abstract class TestCase extends TestbenchTestCase
{
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
