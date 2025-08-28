<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AvatarResource\Pages;
use App\Filament\Resources\AvatarResource\RelationManagers;
use App\Models\Avatar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AvatarResource extends Resource {
    protected static ?string $model           = Avatar::class;
    protected static ?string $navigationIcon  = 'heroicon-s-face-smile';
    protected static ?string $navigationGroup = 'تنظیمات';

    public static function form ( Form $form ): Form {
        return $form->schema([
                                 Forms\Components\TextInput::make('panel_title')
                                                           ->translateLabel()
                                                           ->maxLength(191) ,
                                 Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                                                                              ->translateLabel()
                                                                              ->collection('image')
                                                                              ->image() ,
                                 Forms\Components\TextInput::make('sort')
                                                           ->translateLabel()
                                                           ->numeric() ,
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
                                   Tables\Columns\TextColumn::make('sort')
                                                            ->translateLabel()
                                                            ->numeric()
                                                            ->sortable() ,
                                   Tables\Columns\TextColumn::make('created_at')
                                                            ->translateLabel()
                                                            ->dateTime()
                                                            ->sortable()
                                                            ->toggleable(isToggledHiddenByDefault: true) ,
                                   Tables\Columns\TextColumn::make('updated_at')
                                                            ->translateLabel()
                                                            ->dateTime()
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
            'index' => Pages\ListAvatars::route('/') ,
            'create' => Pages\CreateAvatar::route('/create') ,
            'edit' => Pages\EditAvatar::route('/{record}/edit') ,
        ];
    }

    public static function getPluralLabel (): ?string {
        return __('Avatars');
    }

    public static function getLabel (): ?string {
        return __('Avatar');
    }
}
