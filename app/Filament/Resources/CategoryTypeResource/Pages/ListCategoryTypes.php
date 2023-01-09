<?php

namespace App\Filament\Resources\CategoryTypeResource\Pages;

use App\Filament\Resources\CategoryTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryTypes extends ListRecords
{
    protected static string $resource = CategoryTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
