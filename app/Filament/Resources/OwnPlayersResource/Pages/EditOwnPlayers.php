<?php

namespace App\Filament\Resources\OwnPlayersResource\Pages;

use App\Filament\Resources\OwnPlayersResource;
use App\Models\Player;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Redirect;

class EditOwnPlayers extends EditRecord
{
    protected static string $resource = OwnPlayersResource::class;

    protected function getActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->record->user) {
            if ($this->record->user->email != $data['email']) {
                if (User::where('email', $data['email'])->first() == null) {
                    $user = $this->record->user;
                    $user->email = $data['email'];
                    $user->name = $data['name'];
                    $user->save();
                } else {
                    Notification::make()
                        ->warning()
                        ->title('Error al guardar los datos')
                        ->persistent()
                        ->send();
                    $this->halt();
                }
            } elseif ($this->record->user->name != $data['name']) {
                $user = $this->record->user;
                $user->name = $data['name'];
                $user->save();
            }
        }
        return $data;
    }
}
