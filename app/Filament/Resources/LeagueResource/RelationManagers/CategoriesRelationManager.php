<?php

namespace App\Filament\Resources\LeagueResource\RelationManagers;

use App\Filament\Resources\LeagueResource;
use App\Models\Category;
use App\Models\League;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Request;


class CategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'categories';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $inverseRelationship = 'leagues';

    protected static ?string $modelLabel = 'Categoría';

    protected static ?string $pluralModelLabel = 'Categorías';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
                ])
                ->headerActions([
                    Tables\Actions\CreateAction::make(),
                    Tables\Actions\AssociateAction::make()
                    ->recordSelectOptionsQuery(function (Builder $query, RelationManager $livewire) {
                        return $query->where('category_type_id', $livewire->ownerRecord->category_type_id)->whereNull('league_id');
                    })
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\Action::make('Ver jugadores')->icon('heroicon-o-information-circle')
                    ->url(function (Category $record) {
                        return LeagueResource::getUrl('category-player', ['record' => $record]);
                    }),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DissociateBulkAction::make(),
            ]);
    }
}
