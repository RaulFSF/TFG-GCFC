<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_day_id',
        'local_id',
        'local_score',
        'visitor_id',
        'visitor_score',
        'prompter_id',
        'report',
        'date',
    ];

    protected $casts = [
        'report' => 'array',
    ];

    protected $appends = [
        'formated_date',
        'match_result',
    ];

    public function getMatchResultAttribute(){
        if($this->local_score > -1 && $this->visitor_score > -1){
            return $this->local_score . ' - ' . $this->visitor_score;
        }
        return "Sin resultado";
    }

    public function getFormatedDateAttribute(){
        return Carbon::parse($this->date)->format('H:i d-m-Y');
    }

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
        return $this->belongsTo(Prompter::class);
    }

    protected static function booted()
    {
        $user = User::where('id', auth()->id())->first();
        if(isset($user) && $user->role === 'prompter'){
            static::addGlobalScope('prompter_category_day', function (Builder $builder) {
                 $builder->where('prompter_id', auth()->user()->prompter->id);
            });
        };
    }
}
