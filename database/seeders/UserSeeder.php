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
            'username' => 'superadmin123',
            'password'=>Hash::make('asdfasdf')
        ]);
        $user->assignRole('Super-Admin');
        
        $user2 = \App\Models\User::factory()->create([
            'name' => 'anjas',
            'username' => 'anjas',
            'password'=>Hash::make('asdfasdf'),
            'marhalah_id'=>3,
        ]);
        $user2->assignRole('admin');
        
        $user3 = \App\Models\User::factory()->create([
            'name' => 'Satria Habibi',
            'username' => 'satriahabibi',
            'password'=>Hash::make('asdfasdf'),
            'marhalah_id'=>3,
        ]);
        $user3->assignRole('guru');
        $guru1 = \App\Models\Guru::firstOrCreate([
            'nama' => 'Satria Habibi',
            'marhalah_id'=>3,
            'user_id'=>$user3->id,
        ]);
    }
}