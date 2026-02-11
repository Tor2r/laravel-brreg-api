# Laravel Brreg API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tor2r/laravel-brreg-api.svg?style=flat-square)](https://packagist.org/packages/tor2r/laravel-brreg-api)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tor2r/laravel-brreg-api/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tor2r/laravel-brreg-api/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/tor2r/laravel-brreg-api.svg?style=flat-square)](https://packagist.org/packages/tor2r/laravel-brreg-api)

A Laravel package for fetching data from [Brønnøysundregisteret](https://data.brreg.no/) (the Norwegian Register of Business Enterprises). Supports
both Enhetsregisteret and Frivillighetsregisteret.

## Installation

You can install the package via composer:

```bash
composer require tor2r/laravel-brreg-api
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-brreg-api-config"
```

This is the contents of the published config file:

```php
return [
    'base_url' => env('BRREG_API_BASE_URL', 'https://data.brreg.no'),
    'results_per_page' => env('BRREG_API_RESULTS_PER_PAGE', 100),
];
```

## Usage

### Enhetsregisteret (Business Registry)

```php
use Tor2r\BrregAPi\Facades\BrregAPi;

// Fetch a single entity by organisation number
$entity = BrregAPi::getByOrgnr('987654321');

// Search by (partial) organisation number
$results = BrregAPi::searchByOrgnr('9876543');

// Search by name
$results = BrregAPi::searchByName('Sesam');

// Limit the number of results
$results = BrregAPi::searchByName('Sesam', 10);
```

### Frivillighetsregisteret (Voluntary Organisations Registry)

```php
// Fetch a single voluntary organisation
$org = BrregAPi::voluntary()->getByOrgnr('987654321');

// Search voluntary organisations by name
$results = BrregAPi::voluntary()->searchByName('Frivillig');

// Search voluntary organisations by organisation number
$results = BrregAPi::voluntary()->searchByOrgnr('9876543');
```

### Error Handling

The package throws `Tor2r\BrregAPi\Exceptions\BrregApiException` when something goes wrong:

```php
use Tor2r\BrregAPi\Exceptions\BrregApiException;

try {
    $entity = BrregAPi::getByOrgnr('000000000');
} catch (BrregApiException $e) {
    // "No entity found with organisation number: 000000000"
    echo $e->getMessage();
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Tor L](https://github.com/Tor2r)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
