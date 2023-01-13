<?php

namespace App\Filament\Resources\OwnPlayersResource\Pages;

use App\Filament\Resources\OwnPlayersResource;
use App\Models\Team;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateOwnPlayers extends CreateRecord
{
    protected static string $resource = OwnPlayersResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['team_id'] = Team::where('administrator_id', auth()->id())->first()->id;

        $user = User::where('email', $data['email'])->first();
        if($user){
            $data['user_id'] = $user->id;
        }

        return static::getModel()::create($data);
    }
}
