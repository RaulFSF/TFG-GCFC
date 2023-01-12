<?php

namespace App\Filament\Resources\OwnPlayersResource\Pages;

use App\Filament\Resources\OwnPlayersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOwnPlayers extends EditRecord
{
    protected static string $resource = OwnPlayersResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
