<?php

namespace App\Filament\Resources\DayResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExerciseQuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'exerciseQuestions';
    protected static ?string $title        = 'تمرین ها';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sort')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('type')
                    ->options([
                        'SIMPLE_DESCRIPTION' => __('SIMPLE_DESCRIPTION'),
                        'ORDERED_LIST' => __('ORDERED_LIST'),
                        'PERCENTAGE' => __('PERCENTAGE'),
                        'NOTE' => __('NOTE'),
                        'FILL_IN_THE_BLANK' => __('FILL_IN_THE_BLANK'),
                        'CHECKBOX' => __('CHECKBOX'),
                    ])
                    ->translateLabel()
                    ->required(),

                Section::make()
                       ->columns([
                                     'sm' => 1,
                                 ])
                       ->schema([

                Forms\Components\KeyValue::make('question')
                                         ->columns(3)
                                         ->translateLabel()
                                         ->required()
                                                          ]),
                                    // ...


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('sort')
            ->columns([
                Tables\Columns\TextColumn::make('sort')->translateLabel(),
                Tables\Columns\TextColumn::make('translated_type')->translateLabel(),
                Tables\Columns\TextColumn::make('question')->translateLabel()->wrap(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('sort', 'asc');
    }

    public static function getPluralLabel (): ?string {
        return __('Exercise Questions');
    }

    public static function getRecordLabel (): ?string {
        return __('Exercise Question');
    }
}
