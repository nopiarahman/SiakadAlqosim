<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTambahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $waliKelas = Role::create(['name' => 'waliKelas']);
        $yayasan = Role::create(['name' => 'yayasan']);
        $kepsek = Role::create(['name' => 'kepsek']);
        $developer = Role::create(['name' => 'developer']);
    }
}
