<?php

namespace JeffersonGoncalves\Filament\GdprRetention;

use JeffersonGoncalves\FilamentPluginCore\BasePackageServiceProvider;
use Spatie\LaravelPackageTools\Package;

class GdprRetentionServiceProvider extends BasePackageServiceProvider
{
    public static string $name = 'filament-gdpr-retention';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasTranslations();
    }
}
