<?php

namespace App\Filament\Resources\CategoryTypeResource\Pages;

use App\Filament\Resources\CategoryTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryType extends EditRecord
{
    protected static string $resource = CategoryTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
