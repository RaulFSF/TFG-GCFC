<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function player(){
        return $this->hasOne(Player::class);
    }

    public function prompter(){
        return $this->hasOne(Prompter::class);
    }

    public function scout(){
        return $this->hasOne(Scout::class);
    }

    public function canAccessFilament(): bool
    {
        if($this->role==='president' && Team::where('administrator_id', $this->id)->first()){
            return true;
        } else{
            return ($this->role === 'admin' || $this->role === 'prompter');
        }
    }

    public static function coach($count)
    {
        for ($i = 1; $i <= $count; $i++) {
            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => bcrypt('1234'), // password
                'role' => 'coach',
            ]);
        };
    }

    protected function imageUrl(): Attribute {
        return Attribute::make(
            get: fn () => Storage::url($this->image),
        );
    }
}
