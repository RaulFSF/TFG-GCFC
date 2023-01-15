<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'administrator_id',
        'name',
        'description',
        'shield',
        'categories',
        'field',
    ];

    protected $casts = [
        'categories' => 'array',
        'field' => 'array',
    ];

    public function administrator(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function players(){
        return $this->hasMany(Player::class);
    }

    protected function shieldUrl(): Attribute {
        return Attribute::make(
            get: fn () => Storage::url($this->shield_url),
        );
    }
}
