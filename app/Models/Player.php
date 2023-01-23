<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'category_id',
        'birthdate',
        'team_id',
        'history',
    ];

    protected $casts = [
        'history' => 'array',
    ];

    protected $appends = [
        'age'
    ];

    public function getAgeAttribute(){
        return Carbon::parse($this->birthdate)->age;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
        $user = User::where('id', auth()->id())->first();
        if(isset($user) && $user->role != 'admin' && $user->role !== 'prompter'){
            static::addGlobalScope('owner', function (Builder $builder) {
                 $builder->where('team_id',  Team::where('administrator_id', auth()->user()->id)->first()['id']);
            });
        };
    }

}
