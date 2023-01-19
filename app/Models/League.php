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
        'season',
    ];

    protected $casts = [
        'classification' => 'array',
    ];

    public function categoryType(){
        return $this->hasOne(CategoryType::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function matchDays(){
        return $this->hasMany(MatchDay::class);
    }
}
