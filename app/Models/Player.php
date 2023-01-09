<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'history',
    ];

    protected $casts = [
        'history' => 'array',
    ];

    public function user(){
        return $this->belongsTo('User');
    }
    
    public function category(){
        return $this->belongsTo('Category');
    }
}
