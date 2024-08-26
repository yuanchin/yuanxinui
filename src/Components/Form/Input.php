<?php

namespace Yuanchin\YuanxinUi\Components\Form;

use Illuminate\Support\Str;
use Yuanchin\YuanxinUi\Components\YuanxinUiComponent;

class Input extends YuanxinUiComponent
{
    /**
     * Create a new input component instance.
     *
     * @param string|null $id
     *
     * @return void
     */
    public function __construct(
        public ?string $id = null,
    ) {
        if (empty($this->id)) {
            $this->id = Str::replace('-', '_', Str::uuid());
        }
    }

    protected function handle(array $data)
    {
        return $data;
    }

    protected function blade()
    {
        return view('yuanxinui-form::input');
    }
}
