<?php

namespace Yuanchin\YuanxinUi\Services\FrontendAssets;

use Illuminate\Support\Facades\Blade;
use Livewire\Drawer\Utils;
use Yuanchin\YuanxinUi\Services\Service;

class FrontendAssets extends Service
{
    public function boot()
    {
        Blade::directive('yuanxinUiStyles', [static::class, 'yuanxinUiStyles']);

        Blade::directive('yuanxinUiScripts', [static::class, 'yuanxinUiScripts']);

        /**
         * looking for custom YuanxinUi tags like:
         *
         * ex: <yuanxinui:setup /> or <yuanxinui:styles /> or <yuanxinui:scripts />
         */
        Blade::precompiler(function (string $string) {
            $pattern = '/<\s*yuanxinui\:(setup|scripts|styles)\s*\/>/';

            $layout = preg_replace_callback($pattern, function (array $matches) {
                $styles  = self::styles();
                $scripts = self::scripts();

                return match($matches[1]) {
                    'setup'  => "{$scripts}\n{$styles}",
                    'styles'  => $styles,
                    'scripts' => $scripts
                };
            }, $string);

            return $layout;
        });
    }

    /**
     * Get the styles used by YuanxinUI, by calling the styles().
     *
     * @return string
     */
    public static function yuanxinUiStyles()
    {
        return '{!! \Yuanchin\YuanxinUi\Services\FrontendAssets\FrontendAssets::styles() !!}';
    }

    /**
     * Get the scripts used by YuanxinUi, by calling the script().
     *
     * @return string
     */
    public static function yuanxinUiScripts()
    {
        return '{!! \Yuanchin\YuanxinUi\Services\FrontendAssets\FrontendAssets::scripts() !!}';
    }

    /**
     * Get the HTML code for linking the YuanxinUi CSS file.
     *
     * @return string
     */
    public static function styles()
    {
        return "<link href=\"/yuanxinui/yuanxinui.css\" rel=\"stylesheet\" type=\"text/css\" >";
    }

    /**
     * Get the HTML code for linking the YuanxinUi Javascript file.
     *
     * @return string
     */
    public static function scripts()
    {
        return "<script src=\"/yuanxinui/yuanxinui.js\" defer></script>";
    }

    public function cssFile()
    {
        return Utils::pretendResponseIsFile(
            __DIR__ . '/../../../dist/yuanxinui.css',
            'text/css; charset=utf-8'
        );
    }

    public function javascriptFile()
    {
        return Utils::pretendResponseIsFile(
            __DIR__ . '/../../../dist/yuanxinui.js',
            'application/javascript; charset=utf-8'
        );
    }
}
