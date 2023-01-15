<?php

namespace App\Filament\Resources\TeamResource\Pages;

use App\Filament\Resources\TeamResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTeam extends CreateRecord
{
    protected static string $resource = TeamResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['field'] = [
            'name' => $data['fieldName'],
            'address' => $data['address'],
        ];
        unset($data['fieldName'], $data['address']);
        return $data;
        return $data;
    }
}
