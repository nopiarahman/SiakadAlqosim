<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin',
            'email' => 'superadmin@example.com',
            'password'=>Hash::make('asdfasdf')
        ]);
        $user->assignRole('Super-Admin');
    }
}
