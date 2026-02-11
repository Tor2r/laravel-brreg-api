<?php

namespace Tor2r\BrregAPi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BrregAPiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-brreg-api')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(BrregAPi::class, function () {
            return new BrregAPi;
        });
    }
}
