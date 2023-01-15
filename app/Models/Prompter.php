<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prompter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_matches',
    ];

    protected $casts = [
        'category_matches' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categoryMatches(){
        return $this->hasMany(CategoryMatch::class);
    }
}
