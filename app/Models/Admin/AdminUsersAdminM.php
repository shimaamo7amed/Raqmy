<?php

namespace App\Models\Admin;

use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUsersAdminM extends Authenticatable
{
    use Notifiable;
    // public $timestamps = false ;
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
