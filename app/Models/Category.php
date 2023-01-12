<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    protected static function booted()
    {
        $user = User::where('id', auth()->id())->first();
        if (isset($user) && $user->role !== 'admin') {
            static::addGlobalScope('owner', function (Builder $builder) {
                $builder->where('team_id',  Team::where('administrator_id', auth()->user()->id)->first()['id']);
            });
        }
    }
}
