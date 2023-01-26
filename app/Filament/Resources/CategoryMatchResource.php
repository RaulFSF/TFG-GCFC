<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryMatchResource\Pages;
use App\Filament\Resources\CategoryMatchResource\RelationManagers;
use App\Models\Category;
use App\Models\CategoryMatch;
use App\Models\Player;
use Carbon\Carbon;
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
use Illuminate\Support\Facades\Route;

class CategoryMatchResource extends Resource
{
    protected static ?string $model = CategoryMatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $modelLabel = 'Mis partidos';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role === 'prompter';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereNull('report')->orderBy('date');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
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
                Tables\Actions\Action::make('informe')->icon('heroicon-s-pencil')
                    ->hidden(function (CategoryMatch $record) {
                        return $record->date > Carbon::now() ? false : true;
                    })
                    ->url(function (CategoryMatch $record) {
                        return CategoryMatchResource::getUrl('report', ['record' => $record]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
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
            'report' => Pages\MatchReport::route('/{record}/report'),
        ];
    }
}
