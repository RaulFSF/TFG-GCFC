<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Filament\Resources\OwnPlayersResource;
use App\Models\Player;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlayersRelationManager extends RelationManager
{
    protected static string $relationship = 'players';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $inverseRelationship = 'category'; // Since the inverse related model is `Category`, this is normally `category`, not `section`.


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
                Tables\Columns\TextColumn::make('name')->label('Nombre de jugador'),
                Tables\Columns\TextColumn::make('age')->label('Edad'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AssociateAction::make()
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Ver historial')->icon('heroicon-s-information-circle')
                    ->url(function (Player $record) {
                        return OwnPlayersResource::getUrl('player-history', ['record' => $record]);
                    }),
                Tables\Actions\DissociateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DissociateBulkAction::make(),
            ]);
    }
}
