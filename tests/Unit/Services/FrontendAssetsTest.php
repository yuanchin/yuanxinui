<?php

use Yuanchin\YuanxinUi\Services\FrontendAssets\FrontendAssets;

beforeEach(function () {
    $this->frontendAssets = app(FrontendAssets::class);
});

test('styles', function () {
    expect($this->frontendAssets->styles())
        ->toStartWith('<link href="');
});

test('scripts', function () {
    expect($this->frontendAssets->scripts())
        ->toStartWith('<script src="');
});

test('yuanxinui styles', function () {
    expect($this->frontendAssets->yuanxinUiStyles())
        ->toContain('\Yuanchin\YuanxinUi\Services\FrontendAssets\FrontendAssets::styles()');
});

test('yuanxinui scripts', function () {
    expect($this->frontendAssets->yuanxinUiScripts())
        ->toContain('\Yuanchin\YuanxinUi\Services\FrontendAssets\FrontendAssets::scripts()');
});

it('should make a request to the yuanxinui styles', function () {
    $this->get(route('yuanxinui.yuanxinui.css'))
        ->assertOk()
        ->assertHeader('Content-Type', 'text/css; charset=utf-8');
});

it('should make a request to the yuanxinui scripts', function () {
    $this->get(route('yuanxinui.yuanxinui.js'))
        ->assertOk()
        ->assertHeader('Content-Type', 'application/javascript; charset=utf-8');
});

test('yuanxinUiStyles is compiled', function () {
    expect()->toBeCompiled(
        expected: '<link href="/yuanxinui/yuanxinui.css" rel="stylesheet" type="text/css" >',
        expression: '@yuanxinUiStyles',
    );
});

test('yuanxinUiScripts is compiled', function () {
    expect()->toBeCompiled(
        expected: '<script src="/yuanxinui/yuanxinui.js" defer></script>',
        expression: '@yuanxinUiScripts',
    );
});
