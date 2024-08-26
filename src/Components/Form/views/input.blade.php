<input
    id="yx_input_inner_{{ $id }}"
    @if ($attributes->get('readonly')) readonly @endif
    @if ($attributes->get('disabled')) disabled @endif
    @if ($attributes->get('required')) required @endif
    {{ $attributes->class(['yx-input__inner'])
            ->merge([
                'type'        => 'text',
                'value'       => '',
                'placeholder' => null
            ])
    }}
/>
