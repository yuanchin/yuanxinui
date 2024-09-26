<?php

namespace Tests\Browser\Input;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class InputTest extends BrowserTestCase
{
    /** @test */
    public function it_should_see_prefix_and_suffix_and_prepend_and_append_slot()
    {
        Livewire::test(new class extends Component
        {
            public function render()
            {
                return <<<'HTML'
                <div>
                    <x-yuanxinui-input>
                        <x-slot name="prefix">
                            <span>prefix slot here.</span>
                        </x-slot>

                        <x-slot name="suffix">
                            <span>suffix slot here.</span>
                        </x-slot>

                        <x-slot name="prepend">
                            <span>prepend slot here.</span>
                        </x-slot>

                        <x-slot name="append">
                            <span>append slot here.</span>
                        </x-slot>
                    </x-yuanxinui-input>
                </div>
                HTML;
            }
        })
        ->assertSeeHtml('<span>prefix slot here.</span>')
        ->assertSeeHtml('<span>suffix slot here.</span>')
        ->assertSeeHtml('<span>prepend slot here.</span>')
        ->assertSeeHtml('<span>append slot here.</span>');
    }

    /** @test */
    public function it_should_clear_input_value()
    {
        Livewire::visit(new class extends Component
        {
            public function render()
            {
                return <<<'HTML'
                <div>
                    <x-yuanxinui-input
                        dusk="yxInput"
                        clearable
                    />
                </div>
                HTML;
            }
        })
        ->value('@yxInput', 'yuanxinui component')
        ->click('@yxInput')
        ->click('.yx-input__clearable')
        ->assertAttribute('@yxInput', 'value', '');
    }

    /** @test */
    public function it_should_set_model_value_to_livewire()
    {
        Livewire::visit(new class extends Component
        {
            public $model;

            public function render()
            {
                return <<<'HTML'
                <div>
                    <span dusk="value">{{ $model }}</span>
                    <x-yuanxinui-input dusk="model" wire:model.live="model" />
                </div>
                HTML;
            }
        })
        ->type('@model', 'yuanxinui input component.')
        ->waitForTextIn('@value', 'yuanxinui input component.');
    }
}
