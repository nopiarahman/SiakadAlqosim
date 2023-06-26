<?php

namespace Database\Seeders;

use App\Models\Marhalah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MarhalahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marhalah0 = Marhalah::firstOrCreate([
            'nama' => 'Raudhatul Athfal'
        ]);
        $marhalah1 = \App\Models\Marhalah::firstOrCreate([
            'nama' => 'Salafiyah Uula'
        ]);
        $marhalah2 = \App\Models\Marhalah::firstOrCreate([
            'nama' => 'Salafiyah Wustha Banin'
        ]);
        $marhalah3 = \App\Models\Marhalah::firstOrCreate([
            'nama' => 'Salafiyah Wustha Banaat'
        ]);
        $marhalah4 = \App\Models\Marhalah::firstOrCreate([
            'nama' => 'Salafiyah Ulya Banin'
        ]);
        $marhalah5 = \App\Models\Marhalah::firstOrCreate([
            'nama' => 'Salafiyah Ulya Banaat'
        ]);
        $marhalah2->kelas()->firstOrCreate([
            'nama'=>'VII'
        ]);
        $marhalah2->kelas()->firstOrCreate([
            'nama'=>'VIII'
        ]);
        $marhalah2->kelas()->firstOrCreate([
            'nama'=>'IX'
        ]);
        $marhalah3->kelas()->firstOrCreate([
            'nama'=>'VII'
        ]);
        $marhalah3->kelas()->firstOrCreate([
            'nama'=>'VIII'
        ]);
        $marhalah3->kelas()->firstOrCreate([
            'nama'=>'IX'
        ]);
        $marhalah4->kelas()->firstOrCreate([
            'nama'=>'X'
        ]);
        $marhalah4->kelas()->firstOrCreate([
            'nama'=>'XI'
        ]);
        $marhalah4->kelas()->firstOrCreate([
            'nama'=>'XII'
        ]);
        $marhalah5->kelas()->firstOrCreate([
            'nama'=>'X'
        ]);
        $marhalah5->kelas()->firstOrCreate([
            'nama'=>'XI'
        ]);
        $marhalah5->kelas()->firstOrCreate([
            'nama'=>'XII'
        ]);
    }
}
