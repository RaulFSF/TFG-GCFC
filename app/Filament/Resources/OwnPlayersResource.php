<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwnPlayersResource\Pages;
use App\Filament\Resources\OwnPlayersResource\RelationManagers;
use App\Models\Player;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OwnPlayersResource extends Resource
{
    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Gestión de equipos y jugadores';

    protected static ?string $navigationLabel = 'Jugadores';

    protected static ?string $pluralModelLabel = 'Jugadores';

    protected static ?string $modelLabel = 'jugador';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nombre de jugador'),
                DatePicker::make('birthdate')
                    ->required()
                    ->label('Fecha de nacimiento'),
                TextInput::make('email')
                    ->required()
                    ->label('Correo electrónico')
                    ->columnSpan('full')
                    ->email()
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nombre de jugador'),
                TextColumn::make('category.categoryType.name')
                    ->searchable()
                    ->default('Por asignar')
                    ->label('Categoría'),
                TextColumn::make('age')
                    ->label('Edad'),

                TextColumn::make('team.name')
                    ->searchable()
                    ->label('Equipo')
                    ->default('Sin equipo')
                    ->sortable()
                    ->visible(auth()->user()->role === 'admin'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Ver historial')->icon('heroicon-s-information-circle')
                    ->url(function (Player $record) {
                        return OwnPlayersResource::getUrl('player-history', ['record' => $record]);
                    }),
                Tables\Actions\DeleteAction::make()->visible(auth()->user()->role === 'admin'),
                Tables\Actions\Action::make('eliminar del club')
                    ->action(function (Player $record): void {
                        $record->team_id = null;
                        $record->category_id = null;

                        if ($record->save()) {
                            Notification::make()
                                ->title($record->name . ' ha sido eliminado del club correctamente')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Error al eliminar del club')
                                ->danger()
                                ->send();
                        }
                    })->icon('heroicon-s-x-circle')->color('danger')->visible(auth()->user()->role === 'president')->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOwnPlayers::route('/'),
            'create' => Pages\CreateOwnPlayers::route('/create'),
            'edit' => Pages\EditOwnPlayers::route('/{record}/edit'),
            'player-history' => Pages\ViewPlayerHistory::route('/{record}/player-history'),
        ];
    }
}
