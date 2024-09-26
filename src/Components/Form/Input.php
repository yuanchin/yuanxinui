<?php

namespace Yuanchin\YuanxinUi\Components\Form;

use Illuminate\Support\Str;
use Yuanchin\YuanxinUi\Components\YuanxinUiComponent;

class Input extends YuanxinUiComponent
{
    /**
     * Create a new input component instance.
     *
     * @param boolean|null $clearable
     * @param string|null $id
     * @param string|null $size
     * @param string|null $width
     *
     * @return void
     */
    public function __construct(
        public ?bool $clearable = null,
        public ?string $id = null,
        public ?string $size = null,
        public ?string $width = null
    ) {
        if (empty($this->id)) {
            $this->id = Str::replace('-', '_', Str::uuid());
        }

        $this->width = $this->width
            ? $this->appendWidthUnit($this->width)
            : $this->width;
    }

    protected function appendWidthUnit(string $width, string $unit = 'px')
    {
        if(preg_match('/\d+(px|em|rem|%)$/', $width)) {
            return $width;
        }

        return $width . $unit;
    }

    protected function handle(array $data)
    {
        $data['size'] = $data['size']
            ? $data['size']
            : 'default';

        return $data;
    }

    protected function blade()
    {
        return view('yuanxinui-form::input');
    }
}
