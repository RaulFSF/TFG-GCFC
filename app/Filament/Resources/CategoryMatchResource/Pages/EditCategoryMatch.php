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
}
