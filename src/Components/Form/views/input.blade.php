<div
    id="yx_input_{{ $id }}"
    x-data="yuanxinui_input()"
    x-ref="yx_input"
    @class([
        'yx-input',
        'yx-input--large' => $size === 'large',
        'yx-input--small' => $size === 'small',
        'yx-input--default' => $size === 'default',
        'yx-input--append' => !empty($append),
        'yx-input--prepend' => !empty($prepend),
        'is-disabled' => $attributes->get('disabled')
    ])
    @if (!empty($width)) style="width:{{ $width }}" @endif
>

    @if (!empty($prepend))
    <div class="yx-input__prepend">
        {{ $prepend }}
    </div>
    @endif

    <div x-ref="yx_input_wrapper" class="yx-input__wrapper">

        @if (!empty($prefix))
        <span class="yx-input__prefix">
            <span class="yx-input__prefix-inner">
                {{ $prefix }}
            </span>
        </span>
        @endif

        <input
            x-ref="yx_input_inner"
            @if ($attributes->get('readonly')) readonly @endif
            @if ($attributes->get('disabled')) disabled @endif
            @if ($attributes->get('required')) required @endif
            {{ $attributes->class(['yx-input__inner'])
                    ->merge(['type' => 'text'])
            }}
        />

        @if ($clearable)
        <span class="yx-input__suffix">
            <span class="yx-input__suffix-inner">
                <x-dynamic-component
                    name="x-mark"
                    icon-type="outline"
                    :component="YuanxinUi::component('icon')"
                    x-bind="actions.clearable.trigger"
                    x-show="actions.clearable.state === 'show'"
                    x-transition:enter="yx-transition yx-ease-out yx-duration-500"
                    x-transition:enter-start="yx-opacity-0 yx-scale-0"
                    x-transition:enter-end="yx-opacity-100 yx-scale-100"
                    x-transition:leave="yx-transition yx-ease-in yx-duration-500"
                    x-transition:leave-start="yx-opacity-100 yx-scale-100"
                    x-transition:leave-end="yx-opacity-0 yx-scale-0"
                    class="yx-input__icon yx-input__clearable"
                    style="display: none;"
                />
            </span>
        </span>
        @endif

        @if (!empty($suffix))
        <span class="yx-input__suffix">
            <span class="yx-input__suffix-inner">
                {{ $suffix }}
            </span>
        </span>
        @endif

    </div>

    @if (!empty($append))
    <div class="yx-input__append">
        {{ $append }}
    </div>
    @endif

</div>
