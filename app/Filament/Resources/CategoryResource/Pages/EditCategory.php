<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Player;
use App\Models\Team;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        // $players = Player::where('category_id', $record->id)->get();
        // foreach($players as $player){
        //     if(!in_array($player->id, $record->players)){
        //         $player->category_id=null;
        //         $player->save();
        //     }
        // }

        // foreach($record->players as $player_id){
        //     $player = Player::where('user_id', $player_id)->first();
        //     $player->category_id = $record->id;
        //     $player->save();
        // };

        return $record;
    }
}
