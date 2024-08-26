<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Prefix
    |--------------------------------------------------------------------------
    |
    | It will be used to prefix all YuanxinUi components. This is useful to avoid conflicts
    | with other components registered by other libraries or created by yourself.
    |
    | For example:
    | prefixing as yuanxinui, the input usage will be: <x-yuanxinui-input />
    */
    'prefix' => 'yuanxinui',

    /*
    |--------------------------------------------------------------------------
    | Components
    |--------------------------------------------------------------------------
    |
    | List of all YuanxinUi components.
    */
    'components' => [
        'input' => \Yuanchin\YuanxinUi\Components\Form\Input::class,
    ]
];
