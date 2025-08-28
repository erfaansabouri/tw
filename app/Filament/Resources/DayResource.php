<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DayResource\Pages;
use App\Filament\Resources\DayResource\RelationManagers;
use App\Models\Day;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DayResource extends Resource {
    protected static ?string $model           = Day::class;
    protected static ?string $navigationGroup = 'روز ها';
    protected static ?string $navigationIcon  = 'heroicon-s-calendar-days';

    public static function form ( Form $form ): Form {
        return $form->schema([
                                 Forms\Components\TextInput::make('number')
                                                           ->translateLabel()
                                                           ->required()
                                                           ->numeric()
                                                           ->default(1) ,
                                 Forms\Components\TextInput::make('title')
                                                           ->translateLabel()
                                                           ->maxLength(191) ,
                                 Forms\Components\TextInput::make('success_text')
                                                           ->label('متن موفقیت') ,
                                 Forms\Components\TextInput::make('phrase')
                                                           ->translateLabel()
                                                           ->maxLength(191) ,
                             ]);
    }

    public static function table ( Table $table ): Table {
        return $table->columns([
                                   Tables\Columns\TextColumn::make('number')
                                                            ->translateLabel()
                                                            ->numeric()
                                                            ->sortable() ,
                                   Tables\Columns\TextColumn::make('title')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('phrase')
                                                            ->translateLabel()
                                                            ->searchable() ,
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
                     ->bulkActions([])
                     ->defaultSort('number' , 'asc->$this->translateLabel()');
    }

    public static function getRelations (): array {
        return [
            RelationManagers\LessonsRelationManager::class ,
            RelationManagers\ExerciseQuestionsRelationManager::class ,
        ];
    }

    public static function getPages (): array {
        return [
            'index' => Pages\ListDays::route('/') ,
            'create' => Pages\CreateDay::route('/create') ,
            'edit' => Pages\EditDay::route('/{record}/edit') ,
        ];
    }

    public static function getPluralLabel (): ?string {
        return __('Days');
    }

    public static function getLabel (): ?string {
        return __('Day');
    }
}
