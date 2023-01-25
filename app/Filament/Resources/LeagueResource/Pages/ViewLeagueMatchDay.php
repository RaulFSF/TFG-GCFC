<?php

namespace App\Filament\Resources\LeagueResource\Pages;

use App\Filament\Resources\LeagueResource;
use App\Models\CategoryMatch;
use App\Models\MatchDay;
use Filament\Resources\Pages\Page;
use Filament\Tables;

class ViewLeagueMatchDay extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = LeagueResource::class;

    protected static string $view = 'filament.resources.league-resource.pages.view-league-match-day';

    protected static ?string $title = 'Jornada';

    public MatchDay $matchDay;

    public function mount($record): void
    {
        abort_unless(auth()->user()->role === 'admin', 403);
        $this->matchDay = MatchDay::where('id', $record)->first();
    }

    protected function getTableQuery()
    {
        return CategoryMatch::where('match_day_id', $this->matchDay->id);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('local.name')
                ->label('Local'),
            Tables\Columns\TextColumn::make('visitor.name')
                ->label('Visitante'),
            Tables\Columns\TextColumn::make('formated_date')
                ->label('Fecha'),
            Tables\Columns\TextColumn::make('prompter.user.name')
                ->label('Apuntador'),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
