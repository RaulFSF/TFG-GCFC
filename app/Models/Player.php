<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'image',
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

    public function history(){
        return $this->hasMany(PlayerHistory::class);
    }

    public function scouts(){
        return $this->belongsToMany(Scout::class, 'player_scout', 'player_id', 'scout_id')->withPivot('id', 'date' , 'comment', 'stars', 'created_at', 'updated_at');
    }

    public function follows()
    {
        return $this->belongsToMany(Scout::class, 'player_follow', 'player_id', 'scout_id')->withPivot('created_at', 'updated_at');
    }

    protected static function booted()
    {
        $user = User::where('id', auth()->id())->first();
        if(isset($user) && $user->role != 'admin' && $user->role !== 'prompter' && $user->role !== 'scout'){
            static::addGlobalScope('owner', function (Builder $builder) {
                 $builder->where('team_id',  Team::where('administrator_id', auth()->user()->id)->first()['id']);
            });
        };
    }

    protected function imageUrl(): Attribute {
        return Attribute::make(
            get: fn () => Storage::url($this->image),
        );
    }

}
