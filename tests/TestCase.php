<?php

namespace Tor2r\BrregAPi\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Tor2r\BrregAPi\BrregAPiServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            BrregAPiServiceProvider::class,
        ];
    }
}
