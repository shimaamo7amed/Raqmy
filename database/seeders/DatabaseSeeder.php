<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Users\Role;
use Illuminate\Database\Seeder;
use App\Models\Admin\AdminUsersAdminM;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // php artisan db:seed

        // AdminUsersAdminM::create(
        //     [
        //         "code"=>"915",
        //         'name' => "Raqmy-ADMIN",
        //         'email' => "raqmy@admin.com",
        //         'password' => "Raqmy@admin",
        //     ]
        Role::create(
            [
                'name' => "instructor",
            ]
        );
    }
}
