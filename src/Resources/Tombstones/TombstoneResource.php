<?php

namespace JeffersonGoncalves\Filament\GdprRetention\Resources\Tombstones;

use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Relations\Relation;
use JeffersonGoncalves\Filament\GdprRetention\GdprRetentionPlugin;
use JeffersonGoncalves\Filament\GdprRetention\Resources\Tombstones\Pages\ListTombstones;
use JeffersonGoncalves\GdprRetention\Models\Tombstone;

/**
 * Tombstones hold no personal data: which column of which record was anonymized, and when.
 */
class TombstoneResource extends Resource
{
    protected static ?string $model = Tombstone::class;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model_type')
                    ->label(__('filament-gdpr-retention::filament-gdpr-retention.fields.model'))
                    ->formatStateUsing(fn (string $state): string => static::modelLabel($state)),
                TextColumn::make('model_id')
                    ->label(__('filament-gdpr-retention::filament-gdpr-retention.fields.record'))
                    ->searchable(),
                TextColumn::make('column')
                    ->label(__('filament-gdpr-retention::filament-gdpr-retention.fields.column'))
                    ->fontFamily('mono'),
                TextColumn::make('created_at')
                    ->label(__('filament-gdpr-retention::filament-gdpr-retention.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('model_type')
                    ->label(__('filament-gdpr-retention::filament-gdpr-retention.fields.model'))
                    ->options(fn (): array => Tombstone::query()->distinct()->orderBy('model_type')->pluck('model_type')
                        ->mapWithKeys(fn (string $type): array => [$type => static::modelLabel($type)])->all()),
                SelectFilter::make('column')
                    ->label(__('filament-gdpr-retention::filament-gdpr-retention.fields.column'))
                    ->options(fn (): array => Tombstone::query()->distinct()->orderBy('column')->pluck('column', 'column')->all()),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTombstones::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function modelLabel(string $type): string
    {
        return class_basename(Relation::getMorphedModel($type) ?? $type);
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-gdpr-retention::filament-gdpr-retention.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-gdpr-retention::filament-gdpr-retention.resource.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-gdpr-retention::filament-gdpr-retention.resource.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return GdprRetentionPlugin::get()->getNavigationGroup();
    }

    public static function getNavigationSort(): ?int
    {
        return GdprRetentionPlugin::get()->getNavigationSort();
    }

    public static function getNavigationIcon(): ?string
    {
        return GdprRetentionPlugin::get()->getNavigationIcon();
    }

    public static function getSlug(): string
    {
        return GdprRetentionPlugin::get()->getSlug();
    }
}
