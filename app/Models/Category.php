<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'category_type_id',
        'players',
        'coach',
    ];

    protected $casts = [
        'players' => 'array',
    ];

    protected $appends = [
        'name',
    ];

    public function name() : Attribute
    {
        return Attribute::make(
			get: fn () => $this->team->name . ' - ' . $this->categoryType->name,
		);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function categoryType()
    {
        return $this->belongsTo(CategoryType::class);
    }

    public function categoryMatches()
    {
        return $this->hasMany(CategoryMatch::class);
    }

    public function leagues()
    {
        return $this->belongsToMany(League::class, 'category_league', 'league_id', 'category_id')->withPivot('id','points', 'played','wins', 'draws','losts', 'goals_scored','goals_against','created_at', 'updated_at');
    }

    protected static function booted()
    {
        $user = User::where('id', auth()->id())->first();
        if (isset($user) && $user->role !== 'admin' && $user->role !== 'prompter') {
            static::addGlobalScope('owner', function (Builder $builder) {
                $builder->where('team_id',  Team::where('administrator_id', auth()->user()->id)->first()['id']);
            });
        }
    }
}
