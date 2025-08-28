<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaitingTextResource\Pages;
use App\Filament\Resources\WaitingTextResource\RelationManagers;
use App\Models\WaitingText;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaitingTextResource extends Resource {
    protected static ?string $model           = WaitingText::class;
    protected static ?string $navigationGroup = 'متن های ویتینگ';
    protected static ?string $navigationIcon  = 'heroicon-o-rectangle-stack';

    public static function form ( Form $form ): Form {
        return $form->schema([
                                 Forms\Components\Textarea::make('text')
                                                          ->translateLabel() ,
                             ]);
    }

    public static function table ( Table $table ): Table {
        return $table->columns([
                                   Tables\Columns\TextColumn::make('id')
                                                            ->translateLabel()
                                                            ->numeric()
                                                            ->sortable() ,
                                   Tables\Columns\TextColumn::make('text')
                                                            ->translateLabel() ,
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
            'index' => Pages\ListWaitingTexts::route('/') ,
            'create' => Pages\CreateWaitingText::route('/create') ,
            'edit' => Pages\EditWaitingText::route('/{record}/edit') ,
        ];
    }

    public static function getPluralLabel (): ?string {
        return __('Waiting texts');
    }

    public static function getLabel (): ?string {
        return __('Waiting text');
    }
}
