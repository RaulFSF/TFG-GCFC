<?php

namespace App\Filament\Resources\LeagueResource\Pages;

use App\Filament\Resources\LeagueResource;
use App\Models\Classification;
use App\Models\League;
use App\Models\PlayerHistory;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Illuminate\Support\Facades\DB;

class ViewClassification extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = LeagueResource::class;

    protected static string $view = 'filament.resources.league-resource.pages.view-classification';

    protected static ?string $title = 'Clasificación';

    public League $league;

    public function mount($record): void
    {
        abort_unless(auth()->user()->role === 'admin', 403);
        $this->league = League::where('id', $record)->first();
    }

    protected function getTableQuery()
    {
        return Classification::where('league_id', $this->league->id)->orderByDesc('points')->orderByDesc('wins');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('category.name')
                ->label('Nombre'),
                Tables\Columns\TextColumn::make('points')
                ->label('PTS'),
                Tables\Columns\TextColumn::make('played')
                ->label('J'),
            Tables\Columns\TextColumn::make('wins')
                ->label('G'),
            Tables\Columns\TextColumn::make('draws')
                ->label('E'),
            Tables\Columns\TextColumn::make('losts')
                ->label('P'),
            Tables\Columns\TextColumn::make('goals_scored')
                ->label('GF'),
                Tables\Columns\TextColumn::make('goals_against')
                ->label('GC'),
                Tables\Columns\TextColumn::make('goals_difference')
                ->label('GC'),

        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
