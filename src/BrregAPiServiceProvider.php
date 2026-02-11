<?php

namespace Tor2r\BrregAPi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tor2r\BrregAPi\Commands\BrregAPiCommand;

class BrregAPiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-brreg-api')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_brreg_api_table')
            ->hasCommand(BrregAPiCommand::class);
    }
}
