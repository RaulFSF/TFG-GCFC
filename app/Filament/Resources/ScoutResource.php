<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScoutResource\Pages;
use App\Filament\Resources\ScoutResource\RelationManagers;
use App\Models\Scout;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class ScoutResource extends Resource
{
    protected static ?string $model = Scout::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';

    protected static ?string $navigationGroup = 'Ojeadores';

    protected static ?string $modelLabel = 'Ojeador';

    protected static ?string $pluralModelLabel = 'Ojeadores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user_id')
                ->hidden(),
                TextInput::make('name')
                    ->label('Nombre')->required(),
                TextInput::make('email')
                    ->label('Email')->required()->unique(ignoreRecord:true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nombre'),
                TextColumn::make('user.email')
                    ->label('Email'),
                TextColumn::make('ratings_count')
                    ->label('Nº de jugadores valorados')
                    ->formatStateUsing(function (Scout $record) {
                        return  DB::table('player_scout')->where('scout_id', $record->id)->count();
                    }),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Ver valoraciones')->icon('heroicon-s-information-circle')
                    ->url(function (Scout $record) {
                        return ScoutResource::getUrl('ratings', ['record' => $record]);
                    }),
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
            'index' => Pages\ListScouts::route('/'),
            'create' => Pages\CreateScout::route('/create'),
            'edit' => Pages\EditScout::route('/{record}/edit'),
            'ratings' => Pages\RatingsHistory::route('/{record}/ratings'),
            'view-rating' => Pages\ViewRating::route('/{record}/view-rating'),
        ];
    }
}
