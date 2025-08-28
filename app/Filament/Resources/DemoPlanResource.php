<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DemoPlanResource\Pages;
use App\Filament\Resources\DemoPlanResource\RelationManagers;
use App\Models\DemoPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DemoPlanResource extends Resource {
    protected static ?string $model           = DemoPlan::class;
    protected static ?string $navigationGroup = 'پلان های دمو';
    protected static ?string $navigationIcon  = 'heroicon-o-rectangle-stack';

    public static function form ( Form $form ): Form {
        return $form->schema([
                                 Forms\Components\TextInput::make('title')
                                                           ->translateLabel()
                                                           ->maxLength(191) ,
                                 Forms\Components\TextInput::make('days')
                                                           ->translateLabel()
                                                           ->numeric() ,
                             ]);
    }

    public static function table ( Table $table ): Table {
        return $table->columns([
                                   Tables\Columns\TextColumn::make('title')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('days')
                                                            ->translateLabel()
                                                            ->numeric(),
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
            'index' => Pages\ListDemoPlans::route('/') ,
            'create' => Pages\CreateDemoPlan::route('/create') ,
            'edit' => Pages\EditDemoPlan::route('/{record}/edit') ,
        ];
    }

    public static function getPluralLabel (): ?string {
        return __('Demo plans');
    }

    public static function getLabel (): ?string {
        return __('Demo plan');
    }
}
