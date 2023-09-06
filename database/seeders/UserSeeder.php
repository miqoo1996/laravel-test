<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $admin =  User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret'),
        ]);

       $admin->roles()->attach(Role::query()->where('name', Role::ADMIN)->first()->id, ['created_at' => now(), 'updated_at' => now()]);
    }
}
