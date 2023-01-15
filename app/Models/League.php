<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_type_name',
        'classification',
        'matchday',
        'season',
    ];

    protected $casts = [
        'matchday' => 'array',
        'classification' => 'array',
    ];
}
