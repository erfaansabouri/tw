<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Filters\PlanFilter;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\ApplicationFeature;
use App\Models\User;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDatePicker;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class UserResource extends Resource {
    protected static ?string $model           = User::class;
    protected static ?string $navigationGroup = 'کاربران';
    protected static ?string $navigationIcon  = 'heroicon-m-user-group';

    public static function form ( Form $form ): Form {
        return $form->schema([
                                 Forms\Components\TextInput::make('phone')
                                                           ->translateLabel()
                                                           ->tel()
                                                           ->maxLength(191) ,
                                 Forms\Components\TextInput::make('name')
                                                           ->translateLabel()
                                                           ->maxLength(191) ,
                                 JalaliDatePicker::make('premium_expired_at')
                                                 ->translateLabel()
                                                 ->jalali() ,
                                 Forms\Components\Textarea::make('note')
                                                          ->translateLabel()
                                                          ->columnSpanFull() ,
                             ]);
    }

    public static function table ( Table $table ): Table {
        return $table->columns([
                                   Tables\Columns\TextColumn::make('id')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('phone')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('name')
                                                            ->translateLabel()
                                                            ->searchable() ,
                                   Tables\Columns\TextColumn::make('credit')
                                                            ->label("اعتبار")
                                                            ->badge()
                                                            ->description(function ( User $user ) {
                                                                return "آخرین اشتراک: " . $user->lastPaidTransactionPlanTitle();
                                                            })
                                                            ->color(function ( User $user ) {
                                                                if ( $user->premium_remaining_days == 0 ) {
                                                                    return 'gray';
                                                                }
                                                                else {
                                                                    return 'success';
                                                                }
                                                            })
                                                            ->getStateUsing(fn ( User $user ) => $user->is_premium ? $user->premium_remaining_days . " روز" : "بدون اعتبار") ,
                                   Tables\Columns\TextColumn::make('created_at')
                                                            ->translateLabel()
                                                            ->getStateUsing(fn ( User $user ) => verta($user->created_at)->formatJalaliDatetime())
                                                            ->sortable()
                                                            ->toggleable(isToggledHiddenByDefault: true) ,
                                   Tables\Columns\TextColumn::make('was_online_at')
                                                            ->translateLabel()
                                                            ->getStateUsing(fn ( User $user ) => $user->was_online_at ? verta($user->was_online_at)->formatJalaliDatetime() : "نامشخص")
                                                            ->sortable()
                                                            ->toggleable(isToggledHiddenByDefault: true) ,
                               ])
                     ->filters([
                                   Filter::make('active_users')
                                         ->label('کاربران فعال')
                                         ->query(fn ( Builder $query ): Builder => $query->where('was_online_at' , '>=' , now()->subDays(1))) ,
                                   Filter::make('inactive_users')
                                         ->label('کاربران غیر فعال')
                                         ->query(fn ( Builder $query ): Builder => $query->where('was_online_at' , '<' , now()->subDays(1))) ,
                                   Filter::make('without_purchase')
                                         ->label('کاربران بدون خرید')
                                         ->query(fn ( Builder $query ): Builder => $query->whereDoesntHave('transactions' , function ( $query ) {
                                             $query->whereNotNull('verified_at');
                                         })) ,
                                   Filter::make('with_purchase')
                                         ->label('کاربران با خرید')
                                         ->query(fn ( Builder $query ): Builder => $query->whereHas('transactions' , function ( $query ) {
                                             $query->whereNotNull('verified_at');
                                         })) ,
                                   Filter::make('with_purchase_ended_premium')
                                         ->label('کاربران با خرید که اشتراکشان تمام شده')
                                         ->query(fn ( Builder $query ): Builder => $query->whereHas('transactions' , function ( $query ) {
                                             $query->whereNotNull('verified_at');
                                         })
                                                                                         ->where('premium_expired_at' , '<' , now())) ,
                                   Filter::make('multiPurchase')
                                         ->label('کاربرانی که بیش از یک بار خرید کردند')
                                         ->query(fn ( Builder $query ): Builder => $query->whereHas('transactions' , function ( $query ) {
                                             $query->whereNotNull('verified_at')
                                                   ->groupBy('user_id')
                                                   ->havingRaw('COUNT(*) > 1');
                                         })) ,
                                   PlanFilter::make(),
                               ])
                     ->actions([
                                   Tables\Actions\EditAction::make() ,
                               ])
                     ->bulkActions([
                                       ExportBulkAction::make() ,
                                   ])
                     ->defaultSort('id' , 'desc');
    }

    public static function getRelations (): array {
        return [//
        ];
    }

    public static function getPages (): array {
        return [
            'index' => Pages\ListUsers::route('/') ,
            'create' => Pages\CreateUser::route('/create') ,
            'edit' => Pages\EditUser::route('/{record}/edit') ,
        ];
    }

    public static function getPluralLabel (): ?string {
        return __('Users');
    }

    public static function getLabel (): ?string {
        return __('User');
    }
}
