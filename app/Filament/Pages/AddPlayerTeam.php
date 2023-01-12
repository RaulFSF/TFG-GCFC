<?php

namespace App\Filament\Pages;

use App\Models\Player;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;

class AddPlayerTeam extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.add-player-team';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role === 'president';
    }

    public string $searchedId = '';
    public Player $searchedPlayer;

    public function mount(): void
    {
        abort_unless(auth()->user()->role === 'president', 403);
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('searchedId')
                ->options(Player::withoutGlobalScope('owner')->whereNull('team_id')->get()->pluck('user.email', 'user_id'))
                ->preload()
                ->label('Correo electrónico del jugador')
                ->placeholder('Buscar jugador por correo electrónico...')
                ->searchable(),
        ];
    }

    public function save()
    {
        $this->validate();

        dd($this->searchedId . ' es el id del USUARIO que se quiere añadir. Enviar correo al jugador para que acepte. Por el momento se podrá agregar directamente.');

        $this->team->save();
    }

}
