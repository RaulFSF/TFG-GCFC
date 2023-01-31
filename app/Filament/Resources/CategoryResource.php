<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Filament\Forms;
use Filament\Pages\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationGroup = 'Gestión de equipos y jugadores';

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Categorías';

    protected static ?string $pluralModelLabel = 'Categorías';

    protected static ?string $modelLabel = 'categoría';

    public static function form(Form $form): Form
    {
        $team_category_types = [];
        if(auth()->user()->role != 'admin'){
            $categories = Category::where('team_id', Team::where('administrator_id', auth()->user()->id)->first()['id'])->get()->pluck('category_type_id');
            foreach ($categories as $category) {
                array_push($team_category_types, $category);
            };
        }
        $options = Player::where('category_id', null)->get()->pluck('user.name', 'user_id')->toArray();
        return $form
            ->schema([
                Select::make('category_type_id')
                    ->options(
                        CategoryType::whereNotIn('id', $team_category_types)->get()->pluck('name', 'id')
                    )
                    ->hiddenOn('edit')
                    ->preload()
                    ->hidden(auth()->user()->role === 'admin'),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Categoría')
                    ->hidden(auth()->user()->role === 'president')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('categoryType.name')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable()
                    ->hidden(auth()->user()->role === 'admin'),
                TextColumn::make('players_count')
                    ->label('Jugadores en plantilla')
                    ->counts('players'),
            ])
            ->filters([])
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
            RelationManagers\PlayersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
