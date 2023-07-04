<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\PermissionRegistrar;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Reset cached roles and permissions
         app()[PermissionRegistrar::class]->forgetCachedPermissions();
         $admin = Role::create(['name' => 'admin']);
         $guru = Role::create(['name' => 'guru']);
         $santri = Role::create(['name' => 'santri']);
         $waliSantri = Role::create(['name' => 'waliSantri']);
         $waliKelas = Role::create(['name' => 'waliKelas']);
         $superAdmin = Role::create(['name' => 'Super-Admin']);
         $yayasan = Role::create(['name' => 'yayasan']);
         $kepsek = Role::create(['name' => 'kepsek']);
    }
}
