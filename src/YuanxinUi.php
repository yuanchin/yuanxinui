<?php

namespace Yuanchin\YuanxinUi;

use Illuminate\Support\Facades\Facade;

class YuanxinUi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'yuanchin.yuanxinui';
    }
}
