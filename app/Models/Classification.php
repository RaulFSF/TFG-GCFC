<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $table = 'category_league';

    protected $fillable = [
        'league_id',
        'category_id',
        'played',
        'points',
        'wins',
        'draws',
        'losts',
        'goals_scored',
        'goals_against',
    ];

    protected $appends = [
        'goals_difference',
        'position',
    ];

    public function getPositionAttribute()
    {
        $categories = Classification::where('league_id', $this->league_id)->orderByDesc('points')->orderByDesc('wins')->orderByDesc('goals_scored')->orderBy('goals_against')->get();
        $iterator = 1;
        foreach($categories as $category){
            if($category->category_id === $this->category_id){
                return $iterator;
            }
            $iterator++;
        }
        return '-1';
    }

    public function getGoalsDifferenceAttribute()
    {
        return $this->goals_scored - $this->goals_against;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
