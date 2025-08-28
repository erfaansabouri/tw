<?php

namespace App\Filament\Resources;

use App\Events\PasswordChangedEvent;
use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\Admin;
use App\Models\Secretary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class AdminResource extends Resource {
    protected static ?string $model           = Admin::class;
    protected static ?string $navigationGroup = 'عمومی';
    protected static ?string $navigationIcon  = 'heroicon-m-shield-check';

    public static function form ( Form $form ): Form {
        return $form->schema([
                                 Forms\Components\TextInput::make('name')
                                                           ->translateLabel() ,
                                 Forms\Components\TextInput::make('email')
                                                           ->translateLabel() ,
                                 Forms\Components\TextInput::make('password')
                                                           ->password()
                                                           ->translateLabel()
                                                           ->afterStateHydrated(function ( Forms\Components\TextInput $component , $state ) {
                                                               $component->state('');
                                                           })
                                                           ->afterStateUpdated(function ( Admin $admin , ?string $state , ?string $old ) {
                                                           })
                                                           ->dehydrateStateUsing(fn ( $state ) => Hash::make($state))
                                                           ->dehydrated(fn ( $state ) => filled($state))
                                                           ->required(fn ( string $context ): bool => $context === 'create') ,
                             ]);
    }

    public static function table ( Table $table ): Table {
        return $table->columns([
                                   Tables\Columns\TextColumn::make('name')
                                                            ->translateLabel() ,
                                   Tables\Columns\TextColumn::make('email')
                                                            ->translateLabel() ,
                               ])
                     ->filters([//
                               ])
                     ->actions([
                                   Tables\Actions\EditAction::make() ,
                               ])
                     ->bulkActions([

                                   ]);
    }

    public static function getRelations (): array {
        return [//
        ];
    }

    public static function getPages (): array {
        return [
            'index' => Pages\ListAdmins::route('/') ,
            'create' => Pages\CreateAdmin::route('/create') ,
            'edit' => Pages\EditAdmin::route('/{record}/edit') ,
        ];
    }

    public static function getPluralLabel (): ?string {
        return __('Admins');
    }

    public static function getLabel (): ?string {
        return __('Admin');
    }
}
