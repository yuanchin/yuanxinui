<?php

use Illuminate\Foundation\AliasLoader;
use Yuanchin\YuanxinUi\YuanxinUi;
use Yuanchin\YuanxinUi\YuanxinUiServiceProvider;

beforeEach(function () {
    $this->config = config('yuanxinui');
    $this->yuanxinui = app('yuanchin.yuanxinui');
});

it('should register the YuanxinUi singleton', function () {
    $aliases = AliasLoader::getInstance()
        ->getAliases();

    expect($aliases)->toHaveKey('YuanxinUi');
    expect($aliases['YuanxinUi'])->toBe(YuanxinUi::class);
});

it('should merge yuanxinui config', function () {
    expect($this->config)->toHaveKey('components');
});

it('should register the path of the view ', function () {
    $hints = collect(
        app('view')
            ->getFinder()
            ->getHints()
    );

    $hints = $hints->filter(function ($value, $key) {
        return strpos($key, 'yuanxinui-') === 0;
    })->all();

    $views = collect(
        glob(__DIR__ . '/../../../src/Components/*/views')
    );

    $views->each(function ($path) use ($hints)  {
        $name = str()->kebab(
            $basename = basename(dirname($path))
        );

        expect($hints)->toHaveKey(
            $this->yuanxinui->component($name)
        );

        expect(
            $hints[$this->yuanxinui->component($name)][0]
        )->toContain(
            "src/Components/{$basename}/views"
        );
    });
});

it('should register the blade component', function () {
    $components = collect(
        $this->config['components']
    );

    $aliases = app('blade.compiler')->getClassComponentAliases();

    $components = $components->mapWithKeys(function ($value, $key) {
        return [$this->yuanxinui->component($key) => $value];
    })->all();

    expect($aliases)->toMatchArray($components);
});

it('should add the publish groups', function () {
    $publishGroups = YuanxinUiServiceProvider::$publishGroups;

    expect($publishGroups)
        ->toHaveKey('yuanxinui.config');

    expect(array_key_first($publishGroups['yuanxinui.config']))
        ->toBeFile();

    expect(array_values($publishGroups['yuanxinui.config'])[0])
        ->toEndWith('yuanxinui.php');
});
