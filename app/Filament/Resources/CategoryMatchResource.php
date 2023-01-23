<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryMatchResource\Pages;
use App\Filament\Resources\CategoryMatchResource\RelationManagers;
use App\Models\Category;
use App\Models\CategoryMatch;
use App\Models\Player;
use Filament\Forms;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryMatchResource extends Resource
{
    protected static ?string $model = CategoryMatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {

        if (request()->record) {
            $local_players = Player::where('category_id', Category::where('id', CategoryMatch::where('id', request()->record)->first()->local_id)->first()->id)->get();
            $visitor_players = Player::where('category_id', Category::where('id', CategoryMatch::where('id', request()->record)->first()->visitor_id)->first()->id)->get();
            $players = array_flip(array_merge($local_players->pluck('id', 'name')->toArray(), $visitor_players->pluck('id', 'name')->toArray()));
        }

        return $form
            ->schema([
                Tabs::make('Heading')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('Información general')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('league')->disabled(),
                                        TextInput::make('date')->disabled(),


                                        TextInput::make('local_team')->label('Local')->disabled(),
                                        TextInput::make('visitor_team')->label('Local')->disabled(),
                                    ]),
                            ]),
                        Tabs\Tab::make('Alineaciones')
                            ->schema([
                                Select::make('local_players')
                                    ->label('Jugadores de equipo local')
                                    ->multiple()
                                    ->options($local_players->pluck('name', 'id')),
                                Select::make('visitor_players')
                                    ->label('Jugadores de equipo visitante')
                                    ->multiple()
                                    ->options($visitor_players->pluck('name', 'id')),
                            ]),
                        Tabs\Tab::make('Eventos del partido')
                            ->schema([
                                Select::make('goal_player')
                                    ->label('Gol')
                                    ->options($players)
                                    ->multiple(),
                                Select::make('goal_assist')
                                    ->label('Asistencia')
                                    ->options($players)
                                    ->multiple(),
                                Select::make('yellow_card')
                                    ->label('Tarjetas amarillas')
                                    ->options($players)
                                    ->multiple(),
                                Select::make('red_card')
                                    ->label('Tarjetas rojas')
                                    ->options($players)
                                    ->multiple(),

                            ]),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('matchDay.league.name')->label('Liga'),
                TextColumn::make('local.name')->label('Local'),
                TextColumn::make('visitor.name')->label('Visitante'),
                TextColumn::make('formated_date')->label('Fecha'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCategoryMatches::route('/'),
            'create' => Pages\CreateCategoryMatch::route('/create'),
            'edit' => Pages\EditCategoryMatch::route('/{record}/edit'),
        ];
    }
}
