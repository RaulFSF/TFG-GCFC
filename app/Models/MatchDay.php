<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'league_id',
        'number',
    ];

    protected $appends = [
        'name',
    ];

    public function getNameAttribute(){
        return 'Jornada ' . $this->number;
    }

    public function league(){
        return $this->belongsTo(League::class);
    }

    public function categoryMatches(){
        return $this->hasMany(CategoryMatch::class);
    }
}
