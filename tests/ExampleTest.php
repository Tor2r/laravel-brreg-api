<?php

it('can resolve brreg api from container', function () {
    $api = app(\Tor2r\BrregAPi\BrregAPi::class);

    expect($api)->toBeInstanceOf(\Tor2r\BrregAPi\BrregAPi::class);
});

it('resolves as singleton', function () {
    $api1 = app(\Tor2r\BrregAPi\BrregAPi::class);
    $api2 = app(\Tor2r\BrregAPi\BrregAPi::class);

    expect($api1)->toBe($api2);
});
