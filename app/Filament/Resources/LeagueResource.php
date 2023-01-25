<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeagueResource\Pages;
use App\Filament\Resources\LeagueResource\RelationManagers;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\League;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeagueResource extends Resource
{
    protected static ?string $model = League::class;

    protected static ?string $navigationGroup = 'Gestión de ligas';

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationLabel = 'Ligas';

    protected static ?string $modelLabel = 'Liga';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nombre')
                    ->helperText('Ejemplo: Alevín Grupo 2'),
                Select::make('category_type_id')
                    ->label('Categoría')
                    ->options(
                        CategoryType::all()->pluck('name', 'id'),
                    )
                    ->preload()
                    ->required()
                    ->disabledOn('edit'),
                DatePicker::make('start_date')
                    ->label('Fecha de inicio')
                    ->minDate(now())
                    ->maxDate(now()->addYear(2))
                    ->helperText('La primera jornada de la liga será el Viernes siguiente a la fecha introducida'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre'),
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
            RelationManagers\MatchDaysRelationManager::class,
            RelationManagers\CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeagues::route('/'),
            'create' => Pages\CreateLeague::route('/create'),
            'edit' => Pages\EditLeague::route('/{record}/edit'),
            'match-day' => Pages\ViewLeagueMatchDay::route('/{record}/match-day'),
        ];
    }
}
