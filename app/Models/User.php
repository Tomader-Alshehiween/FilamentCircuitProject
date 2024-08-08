<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;
    public function canAccessPanel(Panel $panel): bool{
        return true;
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';
    const ROLE_SUPERVISOR = 'SUPERVISOR';
    const ROLES = [
        self::ROLE_ADMIN => 'ADMIN',
        self::ROLE_USER => 'USER',
        self::ROLE_SUPERVISOR => 'SUPERVISOR',
    ];

    public function isAdmin(){
        return $this->role === self::ROLE_ADMIN;
    }
    public function isSupervisor(){
        return $this->role === self::ROLE_SUPERVISOR;
    }
    public function isUser(){
        return $this->role === self::ROLE_USER;
    }
}
