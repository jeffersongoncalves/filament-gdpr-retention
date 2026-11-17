<?php

namespace JeffersonGoncalves\Filament\GdprRetention\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\Filament\GdprRetention\GdprRetentionPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                GdprRetentionPlugin::make(),
            ]);
    }
}
