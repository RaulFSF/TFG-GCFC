<?php

namespace App\Filament\Resources\ScoutResource\Pages;

use App\Filament\Resources\ScoutResource;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateScout extends CreateRecord
{
    protected static string $resource = ScoutResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'scout',
            'password' => bcrypt('1234'),
        ]);
        $data['user_id'] = $user->id;
        return $data;
    }
}
