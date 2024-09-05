<?php

use Illuminate\Support\Facades\Route;
use Yuanchin\YuanxinUi\Services\FrontendAssets\FrontendAssets;

Route::group([
    'as' => 'yuanxinui.',
    'prefix' => 'yuanxinui'
], function () {
    Route::get('/yuanxinui.css', [FrontendAssets::class, 'cssFile'])
        ->name('yuanxinui.css');

    Route::get('/yuanxinui.js', [FrontendAssets::class, 'javascriptFile'])
        ->name('yuanxinui.js');
});
