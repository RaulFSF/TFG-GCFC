<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'league_id',
        'category_id',
        'goals',
        'played',
        'assits',
        'yellow_cards',
        'red_cards'
    ];

    public function player(){
        return $this->belongsTo(Player::class);
    }

    public function league(){
        return $this->belongsTo(League::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
