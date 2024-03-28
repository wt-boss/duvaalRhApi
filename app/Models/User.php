<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [ ];

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
        'password' => 'hashed',
    ];

    public function generateMatricule(){
        do {
            $this->matricule = "DU-".Str::random(4);
        } while (static::where('matricule', $this->matricule)->exists());
    }
    public function conges(){
        return $this->hasMany(Conges::class);

    }

    public function sanctions(){
        return $this->hasMany(Sanction::class);

    }

    public function permissions(){
        return $this->hasMany(Permission::class);

    }

    public function presences(){
        return $this->hasMany(Presence::class);

    }
    
    public function role(){
        return $this->belongsTo(Role::class);

    }
}
