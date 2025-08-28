<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoalResource\Pages;
use App\Filament\Resources\GoalResource\RelationManagers;
use App\Models\ApplicationFeature;
use App\Models\Goal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GoalResource extends Resource {
    protected static ?string $model = Goal::class;
    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $navigationGroup = 'اهداف';


    public static function form ( Form $form ): Form {
        return $form->schema([
                                 Forms\Components\TextInput::make('small_title')
                                                           ->translateLabel()
                                                           ->maxLength(191) ,
                                 Forms\Components\TextInput::make('full_title')
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
                                   Tables\Columns\TextColumn::make('small_title')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('full_title')
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
            'index' => Pages\ListGoals::route('/') ,
            'create' => Pages\CreateGoal::route('/create') ,
            'edit' => Pages\EditGoal::route('/{record}/edit') ,
        ];
    }

    public static function getPluralLabel (): ?string {
        return __('Goals');
    }

    public static function getLabel (): ?string {
        return __('Goal');
    }
}
