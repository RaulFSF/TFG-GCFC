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

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        $categories = Category::where('team_id', Team::where('administrator_id', auth()->user()->id)->first()['id'])->get()->pluck('category_type_id');
        $team_category_types = [];
        foreach ($categories as $category) {
            array_push($team_category_types, $category);
        };
        return $form
            ->schema([
                Select::make('category_type_id')
                    ->options(
                        CategoryType::whereNotIn('id', $team_category_types)->get()->pluck('name', 'id')
                        )
                    ->hiddenOn('edit')
                    ->preload(),
                Select::make('players')
                    ->multiple()
                    ->options(Player::where('team_id', Team::where('administrator_id', auth()->user()->id)->first()['id'])->get()->pluck('user.name', 'user_id')->toArray())
                    ->preload()
                    ->searchable()
                    ->columnSpan('full'),
                // Select::make('coach')
                //     ->options(User::where('role', 'coach')->pluck('name', 'id'))
                //     ->disablePlaceholderSelection(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('team.name'),
                TextColumn::make('categoryType.name')->searchable()->sortable(),
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
            //
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
