<?php

namespace Tor2r\BrregAPi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getByOrgnr(string $orgnr)
 * @method static array searchByOrgnr(string $orgnr, ?int $limit = null)
 * @method static array searchByName(string $name, ?int $limit = null)
 * @method static \Tor2r\BrregAPi\BrregAPi voluntary()
 *
 * @see \Tor2r\BrregAPi\BrregAPi
 */
class BrregAPi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Tor2r\BrregAPi\BrregAPi::class;
    }
}
