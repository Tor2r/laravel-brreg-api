<?php

use Illuminate\Support\Facades\Http;
use Tor2r\BrregAPi\BrregAPi;
use Tor2r\BrregAPi\Exceptions\BrregApiException;

it('can fetch an entity by organisation number', function () {
    Http::fake([
        'data.brreg.no/enhetsregisteret/api/enheter/987654321' => Http::response([
            'organisasjonsnummer' => '987654321',
            'navn' => 'Test AS',
            '_links' => ['self' => ['href' => 'https://data.brreg.no/enhetsregisteret/api/enheter/987654321']],
            'respons_klasse' => 'Enhet',
        ]),
    ]);

    $result = app(BrregAPi::class)->getByOrgnr('987654321');

    expect($result)
        ->toBeArray()
        ->toHaveKey('organisasjonsnummer', '987654321')
        ->toHaveKey('navn', 'Test AS')
        ->not->toHaveKey('_links')
        ->not->toHaveKey('respons_klasse');
});

it('throws exception when entity is not found', function () {
    Http::fake([
        'data.brreg.no/enhetsregisteret/api/enheter/000000000' => Http::response(null, 404),
    ]);

    app(BrregAPi::class)->getByOrgnr('000000000');
})->throws(BrregApiException::class, 'No entity found with organisation number: 000000000');

it('throws exception on server error', function () {
    Http::fake([
        'data.brreg.no/enhetsregisteret/api/enheter/987654321' => Http::response('Internal Server Error', 500),
    ]);

    app(BrregAPi::class)->getByOrgnr('987654321');
})->throws(BrregApiException::class, 'Brreg API request failed with status 500');

it('can search by name', function () {
    Http::fake([
        'data.brreg.no/enhetsregisteret/api/enheter?navn=Sesam&size=100' => Http::response([
            '_embedded' => [
                'enheter' => [
                    ['organisasjonsnummer' => '987654321', 'navn' => 'Sesam Stasjon AS', '_links' => [], 'respons_klasse' => 'Enhet'],
                ],
            ],
            'page' => ['size' => 100, 'totalElements' => 1, 'totalPages' => 1, 'number' => 0],
        ]),
    ]);

    $result = app(BrregAPi::class)->searchByName('Sesam');

    expect($result)
        ->toBeArray()
        ->toHaveKey('data')
        ->toHaveKey('meta');

    expect($result['data'])->toHaveCount(1);
    expect($result['data'][0])
        ->toHaveKey('organisasjonsnummer', '987654321')
        ->toHaveKey('navn', 'Sesam Stasjon AS');
});

it('can limit search results', function () {
    Http::fake([
        'data.brreg.no/enhetsregisteret/api/enheter?navn=Test&size=10' => Http::response([
            '_embedded' => ['enheter' => []],
            'page' => ['size' => 10, 'totalElements' => 0, 'totalPages' => 0, 'number' => 0],
        ]),
    ]);

    $result = app(BrregAPi::class)->searchByName('Test', 10);

    expect($result)
        ->toBeArray()
        ->toHaveKey('data')
        ->toHaveKey('meta');

    expect($result['data'])->toBeEmpty();
    expect($result['meta'])->toHaveKey('per_page', 10);
});

it('can fetch voluntary organisations', function () {
    Http::fake([
        'data.brreg.no/frivillighetsregisteret/api/frivillige-organisasjoner/987654321' => Http::response([
            'organisasjonsnummer' => '987654321',
            'navn' => 'Frivillig Org',
        ]),
    ]);

    $result = app(BrregAPi::class)->voluntary()->getByOrgnr('987654321');

    expect($result)
        ->toBeArray()
        ->toHaveKey('organisasjonsnummer', '987654321')
        ->toHaveKey('navn', 'Frivillig Org');
});

it('can search voluntary organisations by name', function () {
    Http::fake([
        'data.brreg.no/frivillighetsregisteret/api/frivillige-organisasjoner?navn=Frivillig&size=100' => Http::response([
            '_embedded' => [
                'frivillige_organisasjoner' => [
                    ['organisasjonsnummer' => '987654321', 'navn' => 'Frivillig Org'],
                ],
            ],
            'page' => ['size' => 100, 'totalElements' => 1, 'totalPages' => 1, 'number' => 0],
        ]),
    ]);

    $result = app(BrregAPi::class)->voluntary()->searchByName('Frivillig');

    expect($result)
        ->toBeArray()
        ->toHaveKey('data')
        ->toHaveKey('meta');

    expect($result['data'])->toHaveCount(1);
    expect($result['data'][0])->toHaveKey('navn', 'Frivillig Org');
});

it('throws exception on search failure', function () {
    Http::fake([
        'data.brreg.no/enhetsregisteret/api/enheter?navn=Test&size=100' => Http::response('Bad Request', 400),
    ]);

    app(BrregAPi::class)->searchByName('Test');
})->throws(BrregApiException::class, 'Brreg API request failed with status 400');

it('uses config values', function () {
    config()->set('brreg-api.results_per_page', 25);

    $api = new BrregAPi;

    Http::fake([
        'data.brreg.no/enhetsregisteret/api/enheter?navn=Config&size=25' => Http::response([
            '_embedded' => ['enheter' => []],
            'page' => ['size' => 25, 'totalElements' => 0, 'totalPages' => 0, 'number' => 0],
        ]),
    ]);

    $result = $api->searchByName('Config');

    expect($result['meta'])->toHaveKey('per_page', 25);
});
