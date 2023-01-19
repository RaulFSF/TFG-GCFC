<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_day_id',
        'local_id',
        'visitor_id',
        'prompter_id',
        'report',
        'date',
    ];

    protected $casts = [
        'report' => 'array',
    ];

    public function matchDay(){
        return $this->belongsTo(MatchDay::class);
    }

    public function local(){
        return $this->belongsTo(Category::class);
    }

    public function visitor(){
        return $this->belongsTo(Category::class);
    }

    public function prompter(){
        return $this->hasOne(Prompter::class);
    }
}
