<?php

namespace App\Filament\Resources\TeamResource\Pages;

use App\Filament\Resources\TeamResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeam extends EditRecord
{
    protected static string $resource = TeamResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['fieldName'] = $data['field']['name'];
        $data['address'] = $data['field']['address'];
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['field'] = [
            'name' => $data['fieldName'],
            'address' => $data['address'],
        ];
        unset($data['fieldName'], $data['address']);
        return $data;
    }
}
