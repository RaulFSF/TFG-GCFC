<?php

namespace App\Filament\Resources\LeagueResource\Pages;

use App\Filament\Resources\LeagueResource;
use App\Models\Category;
use App\Models\MatchDay;
use Carbon\Carbon;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLeague extends CreateRecord
{
    protected static string $resource = LeagueResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['season'] = Carbon::now()->year . '/' . Carbon::now()->year+1;
        
        return $data;
    }
}
