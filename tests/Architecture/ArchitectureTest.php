<?php

test('debugging methods should not be used')
    ->expect(['dd', 'dump', 'var_dump', 'ray'])
    ->not->toBeUsed();
