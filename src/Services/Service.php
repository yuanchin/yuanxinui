<?php

namespace Yuanchin\YuanxinUi\Services;

abstract class Service
{
    public function register()
    {
        app()->instance(static::class, $this);
    }

    public function boot()
    {
        //
    }
}
