<?php

namespace Yuanchin\YuanxinUi;

class YuanxinUiManager
{
    /**
     * Create a new yuanxinui instance.
     *
     * @param array|null $config
     *
     * @return void
     */
    public function __construct(
        public ?array $config = null
    ) { }

    /**
     * Get the component name with the additional prefix.
     *
     * @param string $name
     *
     * @return string
     */
    public function component(string $name)
    {
        return blank($this->config['prefix'])
            ? $name
            : str($name)->start($this->config['prefix'] . '-')->value();
    }
}

