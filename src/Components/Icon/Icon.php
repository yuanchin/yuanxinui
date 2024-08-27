<?php

namespace Yuanchin\YuanxinUi\Components\Icon;

use Yuanchin\YuanxinUi\Components\YuanxinUiComponent;

class Icon extends YuanxinUiComponent
{
    /**
     * Create a new icon component instance.
     *
     * @param string $name
     * @param string|null $iconType
     *
     * @return void
     */
    public function __construct(
        public string $name,
        public ?string $iconType = null
    ) { }

    protected function handle(array $data)
    {
        $data['iconType'] = $data['iconType']
            ? $data['iconType']
            : 'solid';

        $data['icon'] = 'yuanxinui-icon::' . $data['iconType'] . '.' . $data['name'];

        return $data;
    }

    protected function blade()
    {
        return view('yuanxinui-icon::icon');
    }
}
