<?php

namespace App\Filament\Pages;

use App\Mail\AddPlayerTeamMail;
use App\Models\Player;
use App\Models\Team;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Mail;

class AddPlayerTeam extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Gestión de equipos y jugadores';

    protected static string $view = 'filament.pages.add-player-team';

    protected static ?string $title = 'Añadir jugador existente al club';

    protected static ?string $navigationLabel = 'Añadir jugador al club';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role === 'president';
    }

    public $searchedId;
    public Player $searchedPlayer;

    public function mount(): void
    {
        abort_unless(auth()->user()->role === 'president', 403);
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('searchedId')
                ->options(Player::withoutGlobalScope('owner')->whereNull('team_id')->get()->pluck('email', 'id'))
                ->preload()
                ->label('Correo electrónico del jugador')
                ->placeholder('Buscar jugador por correo electrónico...')
                ->searchable(),
        ];
    }

    public function save()
    {
        $this->validate();
        $user = Player::withoutGlobalScope('owner')->where('id', $this->searchedId)->first();

        if (Mail::to($user->email)->send(new AddPlayerTeamMail($user))) {
            Notification::make()
                ->title('Correo enviado a ' . $user->email . ' correctamente')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Error al enviar correo')
                ->danger()
                ->send();
            $this->halt();
        };

        $user->team_id = Team::where('administrator_id', auth()->id())->first()->id;

        if ($user->save()) {
            Notification::make()
                ->title($user->name . ' añadido correcctamente al equipo. ')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Error al añadir jugador al equipo')
                ->danger()
                ->send();
            $this->halt();
        };
    }
}
