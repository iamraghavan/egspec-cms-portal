<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'avatar',
        'two_factor_enabled',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'remember_token',
        'email_verified_at',
        'department',          // Added department field
        'profile_role',        // Added profile_role field
        'staff_student_id',    // Added staff_student_id field
        'title',               // Added title field
        'google_id',           // Added google_id field
        'facebook_id',         // Added facebook_id field
        'bio',                 // Added bio field
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',       // Optionally hide two_factor_secret for security
        'two_factor_recovery_codes' // Optionally hide recovery codes for security
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'two_factor_enabled' => 'boolean',
        'two_factor_recovery_codes' => 'array', // Cast to array for easier handling
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role)
    {
        return $this->role && $this->role->name === $role;
    }

    public function twoFactorAuthEnabled()
    {
        return !is_null($this->two_factor_secret);
    }
}
