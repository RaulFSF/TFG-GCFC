<?php

namespace App\Filament\Resources\SeasonResource\RelationManagers;

use App\Filament\Resources\LeagueResource;
use App\Models\CategoryType;
use App\Models\League;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaguesRelationManager extends RelationManager
{
    protected static string $relationship = 'leagues';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $modelLabel = 'Liga';

    protected static ?string $pluralModelLabel = 'Ligas';


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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre'),
                // TextColumn::make('categories_count')->label('Número de Categorías')->counts('categories'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('Ver liga')->icon('heroicon-s-information-circle')
                    ->url(function (League $record) {
                        return LeagueResource::getUrl('edit', ['record' => $record]);
                    }),
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
