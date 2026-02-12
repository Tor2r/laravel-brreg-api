<?php

namespace Tor2r\BrregApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getByOrgnr(string $orgnr)
 * @method static array searchByName(string $name, ?int $limit = null)
 * @method static \Tor2r\BrregApi\BrregApi voluntary()
 *
 * @see \Tor2r\BrregApi\BrregApi
 */
class BrregApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Tor2r\BrregApi\BrregApi::class;
    }
}
