<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'age',
        'bio',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Check if user is Admin (only one admin type)
    public function isAdmin()
    {
        return $this->role === 'Admin' || $this->role === 'admin';
    }

    // Check if user is a regular member (not admin)
    public function isMember()
    {
        return !$this->isAdmin();
    }

    // Get display role
    public function getDisplayRole()
    {
        return $this->role;
    }
}