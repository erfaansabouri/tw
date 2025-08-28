<?php

namespace App\Filament\Resources\DayResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonsRelationManager extends RelationManager {
    protected static string  $relationship = 'lessons';
    protected static ?string $title        = 'درس ها';

    public function form ( Form $form ): Form {
        return $form->schema([
                                 Forms\Components\Textarea::make('description')
                                                          ->rows(10)
                                                          ->cols(20)
                                                          ->translateLabel()
                                                          ->required()
                                                          ->maxLength(255) ,
                                 Forms\Components\TextInput::make('sort')
                                                           ->translateLabel()
                                                           ->required()
                                                           ->numeric() ,
                             ]);
    }

    public function table ( Table $table ): Table {
        return $table->recordTitleAttribute('description')
                     ->columns([
                                   Tables\Columns\TextColumn::make('description')
                                                            ->wrap()
                                                            ->translateLabel() ,
                                   Tables\Columns\TextColumn::make('sort')
                                                            ->translateLabel() ,
                               ])
                     ->filters([//
                               ])
                     ->headerActions([
                                         Tables\Actions\CreateAction::make() ,
                                     ])
                     ->actions([
                                   Tables\Actions\EditAction::make() ,
                                   Tables\Actions\DeleteAction::make() ,
                               ])
                     ->bulkActions([
                                       Tables\Actions\BulkActionGroup::make([
                                                                                Tables\Actions\DeleteBulkAction::make() ,
                                                                            ]) ,
                                   ])->defaultSort('sort', 'asc');
    }

    public static function getPluralLabel (): ?string {
        return __('Lessons');
    }

    public static function getRecordLabel (): ?string {
        return __('Lesson');
    }
}
