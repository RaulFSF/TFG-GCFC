<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function players(){
        return $this->belongsToMany(Player::class, 'player_scout', 'player_id', 'scout_id')->withPivot('id', 'ratings', 'follow', 'created_at', 'updated_at');
    }
}
