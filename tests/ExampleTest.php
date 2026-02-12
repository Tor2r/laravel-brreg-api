<?php

it('can resolve brreg api from container', function () {
    $api = app(\Tor2r\BrregApi\BrregApi::class);

    expect($api)->toBeInstanceOf(\Tor2r\BrregApi\BrregApi::class);
});

it('resolves as singleton', function () {
    $api1 = app(\Tor2r\BrregApi\BrregApi::class);
    $api2 = app(\Tor2r\BrregApi\BrregApi::class);

    expect($api1)->toBe($api2);
});
