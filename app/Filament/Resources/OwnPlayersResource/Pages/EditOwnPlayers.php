<?php

namespace App\Filament\Resources\OwnPlayersResource\Pages;

use App\Filament\Resources\OwnPlayersResource;
use App\Models\Player;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Redirect;

class EditOwnPlayers extends EditRecord
{
    protected static string $resource = OwnPlayersResource::class;

    protected function getActions(): array
    {
        return [
        ];
    }
}
