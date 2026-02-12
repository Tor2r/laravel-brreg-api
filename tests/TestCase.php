<?php

namespace Tor2r\BrregApi\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Tor2r\BrregApi\BrregApiServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            BrregApiServiceProvider::class,
        ];
    }
}
