<?php

it('can render')
    ->expect('<x-yuanxinui-input />')
    ->render()
    ->toContain('<input');
