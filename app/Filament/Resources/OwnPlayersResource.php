<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwnPlayersResource\Pages;
use App\Filament\Resources\OwnPlayersResource\RelationManagers;
use App\Models\Player;
use Filament\Forms;
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

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Jugadores del club';

    protected static ?string $pluralModelLabel = 'Jugadores';

    protected static ?string $modelLabel = 'jugador';




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label('Nombre de jugador'),
                TextColumn::make('category.categoryType.name')
                    ->searchable()
                    ->default('Por asignar')
                    ->label('Categoría'),
                TextColumn::make('team.name')
                    ->searchable()
                    ->default('Sin equipo')
                    ->sortable()
                    ->visible(auth()->user()->role==='admin'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->visible(auth()->user()->role==='admin'),
                Tables\Actions\Action::make('eliminar del club')
                    ->action(function (Player $record) : void {
                        $record->team_id = null;
                        $record->save();
                })->icon('heroicon-s-x-circle')->color('danger')->visible(auth()->user()->role==='president'),
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
        ];
    }
}
