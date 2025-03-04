<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;

class AdminUsersAdminM extends Authenticatable
{
    // public $timestamps = false;
    protected $table = "admin_users_admin";
    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'password',
        'remember_token',
    ];
    protected $casts = [
        "password" => "hashed"
    ];
}
