<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'player_scout';

    protected $fillable = [
        'player_id',
        'scout_id',
        'stars',
        'date',
        'comment',
    ];

    public function player(){
        return $this->belongsTo(Player::class);
    }

    public function scout(){
        return $this->belongsTo(Scout::class);
    }
}
