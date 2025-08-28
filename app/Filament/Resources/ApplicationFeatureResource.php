<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationFeatureResource\Pages;
use App\Filament\Resources\ApplicationFeatureResource\RelationManagers;
use App\Models\ApplicationFeature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApplicationFeatureResource extends Resource {
    protected static ?string $model           = ApplicationFeature::class;
    protected static ?string $navigationGroup = 'تنظیمات';
    protected static ?string $navigationIcon  = 'heroicon-m-presentation-chart-line';

    public static function form ( Form $form ): Form {
        return $form->schema([
                                 Forms\Components\TextInput::make('panel_title')
                                                           ->translateLabel()
                                                           ->maxLength(191) ,
                                 Forms\Components\TextInput::make('description')
                                                           ->translateLabel()
                                                           ->maxLength(191) ,
                                 Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                                                                              ->translateLabel()
                                                                              ->collection('image')
                                                                              ->image() ,
                                 Forms\Components\TextInput::make('sort')
                                                           ->translateLabel()
                                                           ->required()
                                                           ->numeric()
                                                           ->default(0) ,
                             ]);
    }

    public static function table ( Table $table ): Table {
        return $table->columns([
                                   Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                                                                               ->translateLabel()
                                                                               ->collection('image') ,
                                   Tables\Columns\TextColumn::make('panel_title')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('description')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('sort')
                                                            ->translateLabel()
                                                            ->numeric()
                                                            ->sortable() ,
                                   Tables\Columns\TextColumn::make('created_at')
                                                            ->translateLabel()
                                                            ->getStateUsing(fn ( ApplicationFeature $applicationFeature ) => verta($applicationFeature->created_at)->formatJalaliDatetime())
                                                            ->sortable()
                                                            ->toggleable(isToggledHiddenByDefault: true) ,
                                   Tables\Columns\TextColumn::make('updated_at')
                                                            ->translateLabel()
                                                            ->getStateUsing(fn ( ApplicationFeature $applicationFeature ) => verta($applicationFeature->updated_at)->formatJalaliDatetime())
                                                            ->sortable()
                                                            ->toggleable(isToggledHiddenByDefault: true) ,
                               ])
                     ->filters([//
                               ])
                     ->actions([
                                   Tables\Actions\EditAction::make() ,
                               ])
                     ->bulkActions([
                                       Tables\Actions\BulkActionGroup::make([
                                                                                Tables\Actions\DeleteBulkAction::make() ,
                                                                            ]) ,
                                   ]);
    }

    public static function getRelations (): array {
        return [//
        ];
    }

    public static function getPages (): array {
        return [
            'index' => Pages\ListApplicationFeatures::route('/') ,
            'create' => Pages\CreateApplicationFeature::route('/create') ,
            'edit' => Pages\EditApplicationFeature::route('/{record}/edit') ,
        ];
    }

    public static function getPluralLabel (): ?string {
        return __('Application features');
    }

    public static function getLabel (): ?string {
        return __('Application feature');
    }
}
