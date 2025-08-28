<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\ApplicationFeature;
use App\Models\Plan;
use App\Models\Transaction;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDatePicker;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource {
    protected static ?string $model           = Transaction::class;
    protected static ?string $navigationGroup = 'مالی';
    protected static ?string $navigationIcon  = 'heroicon-o-currency-dollar';

    public static function form ( Form $form ): Form {
        return $form->schema([
                                 Forms\Components\TextInput::make('user.name')
                                                           ->translateLabel()
                                                           ->numeric() ,
                                 Forms\Components\TextInput::make('plan_id')
                                                           ->translateLabel()
                                                           ->numeric() ,
                                 Forms\Components\TextInput::make('total_price')
                                                           ->translateLabel()
                                                           ->numeric() ,
                                 Forms\Components\TextInput::make('transaction_id')
                                                           ->translateLabel()
                                                           ->maxLength(191) ,
                                 Forms\Components\TextInput::make('reference_id')
                                                           ->translateLabel()
                                                           ->maxLength(191)
                                                           ->translateLabel() ,
                                 Forms\Components\TextInput::make('order_id')
                                                           ->translateLabel()
                                                           ->maxLength(191) ,
                             ]);
    }

    public static function table ( Table $table ): Table {
        return $table->columns([
                                   Tables\Columns\TextColumn::make('id')
                                                            ->translateLabel() ,
                                   Tables\Columns\TextColumn::make('user.name')
                                                            ->description(function ( Transaction $transaction ) {
                                                                return $transaction->user->phone;
                                                            })
                                                            ->translateLabel()
                                                            ->sortable() ,
                                   Tables\Columns\TextColumn::make('plan.title')
                                                            ->translateLabel()
                                                            ->sortable() ,
                                   Tables\Columns\TextColumn::make('total_price')
                                                            ->translateLabel()
                                                            ->numeric()
                                                            ->sortable() ,
                                   Tables\Columns\TextColumn::make('verified_at')
                                                            ->translateLabel()
                                                            ->getStateUsing(fn ( Transaction $transaction ) => $transaction->verified_at ? verta($transaction->verified_at)->formatJalaliDatetime() : "تایید نشده") ,
                                   Tables\Columns\TextColumn::make('transaction_id')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('reference_id')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('order_id')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('created_at')
                                                            ->translateLabel()
                                                            ->getStateUsing(fn ( Transaction $transaction ) => verta($transaction->created_at)->formatJalaliDatetime())
                                                            ->sortable()
                                                            ->toggleable(isToggledHiddenByDefault: true) ,
                                   Tables\Columns\TextColumn::make('updated_at')
                                                            ->translateLabel()
                                                            ->getStateUsing(fn ( Transaction $transaction ) => verta($transaction->updated_at)->formatJalaliDatetime())
                                                            ->sortable()
                                                            ->toggleable(isToggledHiddenByDefault: true) ,
                               ])
                     ->filters([
                                   TernaryFilter::make('verified_at')
                                       ->label("تایید شده")
                                                ->nullable() ,
                                   Tables\Filters\SelectFilter::make('plan_id')
                                                              ->translateLabel()
                                                              ->options(fn () => Plan::query()
                                                                                     ->pluck('title' , 'id')
                                                                                     ->toArray()) ,
                                   Filter::make('created_at')
                                         ->form([
                                                    JalaliDatePicker::make('created_from')->label('از تاریخ') ,
                                                    JalaliDatePicker::make('created_until')->label('تا تاریخ') ,
                                                ])
                                         ->query(function ( Builder $query , array $data ): Builder {
                                             return $query->when($data[ 'created_from' ] , fn ( Builder $query , $date ): Builder => $query->whereDate('created_at' , '>=' , $date) ,)
                                                          ->when($data[ 'created_until' ] , fn ( Builder $query , $date ): Builder => $query->whereDate('created_at' , '<=' , $date) ,);
                                         }),
                               ])
                     ->actions([])
                     ->bulkActions([])
                     ->defaultSort('id' , 'desc');
    }

    public static function getRelations (): array {
        return [//
        ];
    }

    public static function getPages (): array {
        return [
            'index' => Pages\ListTransactions::route('/') ,
            'create' => Pages\CreateTransaction::route('/create') ,
            'edit' => Pages\EditTransaction::route('/{record}/edit') ,
        ];
    }

    public static function getPluralLabel (): ?string {
        return __('Transactions');
    }

    public static function getLabel (): ?string {
        return __('Transaction');
    }
}
