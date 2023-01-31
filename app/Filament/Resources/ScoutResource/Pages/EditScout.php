<?php

namespace App\Filament\Resources\ScoutResource\Pages;

use App\Filament\Resources\ScoutResource;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScout extends EditRecord
{
    protected static string $resource = ScoutResource::class;

    public $user_id;
    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $this->user_id = $data['user_id'];

        $user = User::where('id', $data['user_id'])->first();

        $data['name'] = $user->name;
        $data['email'] = $user->email;
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = User::where('id', $this->user_id)->first();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        unset($data['name'], $data['email']);
        $data['user_id'] = $this->user_id;
        
        return $data;
    }
}
