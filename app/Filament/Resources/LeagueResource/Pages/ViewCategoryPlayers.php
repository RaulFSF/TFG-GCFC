<?php

namespace App\Filament\Resources\LeagueResource\Pages;

use App\Filament\Resources\LeagueResource;
use App\Models\Category;
use App\Models\Player;
use App\Models\PlayerHistory;
use Filament\Resources\Pages\Page;
use Filament\Tables;

class ViewCategoryPlayers extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = LeagueResource::class;

    protected static string $view = 'filament.resources.league-resource.pages.view-category-players';

    protected static ?string $title = 'Jugadores';

    public Category $category;

    public function mount($record): void
    {
        abort_unless(auth()->user()->role === 'admin', 403);
        $this->category = Category::where('id', $record)->first();
    }

    protected function getTableQuery()
    {
        return PlayerHistory::where('category_id', $this->category->id);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('player.name')
                ->label('Nombre'),
            Tables\Columns\TextColumn::make('played')
                ->label('Partidos jugados'),
            Tables\Columns\TextColumn::make('goals')
                ->label('Goles'),
            Tables\Columns\TextColumn::make('assits')
                ->label('Asistencias'),
            Tables\Columns\TextColumn::make('yellow_cards')
                ->label('Tarjetas amarillas'),
            Tables\Columns\TextColumn::make('red_cards')
                ->label('Tarkjetas rojas'),

        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
