<?php

namespace Tor2r\BrregAPi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tor2r\BrregAPi\BrregAPi
 */
class BrregAPi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Tor2r\BrregAPi\BrregAPi::class;
    }
}
