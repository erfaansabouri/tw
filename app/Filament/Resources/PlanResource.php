<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Filament\Resources\PlanResource\RelationManagers;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;
    protected static ?string $navigationGroup = 'مالی';

    protected static ?string $navigationIcon = 'heroicon-m-swatch';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('monthly_price')->translateLabel()
                    ->numeric(),
                Forms\Components\TextInput::make('total_price')->translateLabel()
                    ->numeric(),
                Forms\Components\TextInput::make('title')->translateLabel()
                    ->maxLength(191),
                Forms\Components\TextInput::make('subtitle_1')->translateLabel()
                    ->maxLength(191),
                Forms\Components\TextInput::make('subtitle_2')->translateLabel()
                    ->maxLength(191),
                Forms\Components\TextInput::make('title_under_price')->translateLabel()
                    ->maxLength(191),
                Forms\Components\TextInput::make('days')->translateLabel()
                    ->numeric(),
                Forms\Components\Toggle::make('is_unlimited')->translateLabel()
                    ->required(),
                Forms\Components\TextInput::make('sort')->translateLabel()
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('strikethrough_price')->translateLabel()
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('monthly_price')->translateLabel()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')->translateLabel()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle_1')->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle_2')->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title_under_price')->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('days')->translateLabel()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_unlimited')->translateLabel()
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort')->translateLabel()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('strikethrough_price')->translateLabel()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }

    public static function getPluralLabel (): ?string {
        return __('Plans');
    }

    public static function getLabel (): ?string {
        return __('Plan');
    }
}
