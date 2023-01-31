<?php

namespace App\Filament\Resources\OwnPlayersResource\Pages;

use App\Filament\Resources\OwnPlayersResource;
use App\Models\Player;
use App\Models\PlayerHistory;
use Filament\Resources\Pages\Page;
use Filament\Tables;

class ViewPlayerHistory extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = OwnPlayersResource::class;

    protected static string $view = 'filament.resources.own-players-resource.pages.view-player-history';

    protected static ?string $title = 'Historial';

    public Player $player;

    public function mount($record): void
    {
        abort_unless(auth()->user()->role === 'admin' || auth()->user()->role === 'president', 403);
        $this->player = Player::where('id', $record)->first();
    }

    protected function getTableQuery()
    {
        return PlayerHistory::where('player_id', $this->player->id);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('league.season.name')
                ->label('Temporada'),
            Tables\Columns\TextColumn::make('league.name')
                ->label('Liga'),
            Tables\Columns\TextColumn::make('category.name')
                ->label('Liga'),
            Tables\Columns\TextColumn::make('played')
                ->label('Jugados'),
            Tables\Columns\TextColumn::make('goals')
                ->label('Goles'),
            Tables\Columns\TextColumn::make('assits')
                ->label('Asistencias'),
            Tables\Columns\TextColumn::make('yellow_cards')
                ->label('T. amarillas'),
            Tables\Columns\TextColumn::make('red_cards')
                ->label('T. rojas'),

        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
