<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_type_id',
        'classification',
        'season_id',
        'start_date',
    ];

    protected $casts = [
        'classification' => 'array',
    ];

    public function season(){
        return $this->belongsTo(Season::class);
    }

    public function categoryType(){
        return $this->hasOne(CategoryType::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'category_league', 'league_id', 'category_id')->withPivot('id','created_at', 'updated_at');
    }

    public function matchDays(){
        return $this->hasMany(MatchDay::class);
    }
}
