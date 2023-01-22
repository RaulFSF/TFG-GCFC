<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Team;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationGroup = 'Gestión de equipos y jugadores';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Equipos';

    protected static ?string $pluralModelLabel = 'Equipos';

    protected static ?string $modelLabel = 'Equipo';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nombre'),
                Forms\Components\Select::make('administrator_id')
                    ->preload()
                    ->label('Administrador')
                    ->options(
                        function (Team $record) {
                            $users = User::where('role', 'president')->whereNotIn('id', Team::all()->pluck('administrator_id')->toArray())->union(User::where('id', $record->administrator->id))->get()->pluck('name', 'id')->toArray();
                            return $users;
                        }
                    )
                    ->disablePlaceholderSelection()
                    ->hiddenOn('create'),
                Forms\Components\Select::make('administrator_id')
                    ->preload()
                    ->options(User::where('role', 'president')->whereNotIn('id', Team::all()->pluck('administrator_id')->toArray())->get()->pluck('name', 'id'))
                    ->required()
                    ->hiddenOn('edit'),
                Section::make('Información del campo')
                    ->schema([
                        TextInput::make('fieldName')
                            ->label('Nombre')
                            ->required(),
                        TextInput::make('address')
                            ->label('Dirección')
                            ->helperText('Introduzca la url que ofrece google maps.')
                            ->required()
                            ->url(),
                    ])
                    ->columnSpan(1)
                    ->label('Información del campo'),
                Forms\Components\FileUpload::make('shield')
                    ->image()
                    ->label('Escudo'),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('shield')
                    ->label('Escudo'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre'),
                Tables\Columns\TextColumn::make('categories_count')
                    ->label('Número de categorías')
                    ->counts('categories'),
                Tables\Columns\TextColumn::make('players_count')
                    ->label('Número de jugadores')
                    ->counts('players'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
