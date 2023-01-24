<?php

namespace App\Filament\Resources\CategoryMatchResource\Pages;

use App\Filament\Resources\CategoryMatchResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryMatch extends EditRecord
{
    protected static string $resource = CategoryMatchResource::class;

    protected function getActions(): array
    {
        return [
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['league'] = $this->record->matchDay->league->name;
        $data['local_team'] = $this->record->local->team->name;
        $data['visitor_team'] = $this->record->visitor->team->name;


        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        dd($data);


        $data['league'] = $this->record->matchDay->league->name;
        $data['local_team'] = $this->record->local->team->name;
        $data['visitor_team'] = $this->record->visitor->team->name;


        return $data;
    }

}
