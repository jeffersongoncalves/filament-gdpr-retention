<?php

namespace JeffersonGoncalves\Filament\GdprRetention;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GdprRetentionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-gdpr-retention')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations();
    }
}
