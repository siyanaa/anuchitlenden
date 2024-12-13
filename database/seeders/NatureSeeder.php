<?php

namespace Database\Seeders;

use App\Models\Nature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nature::create([
            'title' => 'नगद',
            'type'  => 'cash'
        ]);
        Nature::create([
            'title' => 'चेक',
            'type'  => 'cash'
        ]);
        Nature::create([
            'title' => 'खातामा जम्मा',
            'type'  => 'cash'
        ]);
        Nature::create([
            'title' => 'जग्गा (विघा-कठ्ठा-धुरमा)',
            'type'  => 'land'
        ]);
        Nature::create([
            'title' => 'तमसुक',
            'type'  => 'cash'
        ]);
        Nature::create([
            'title' => 'सुन (ग्राममा)',
            'type'  => 'gram'
        ]);
        Nature::create([
            'title' => 'चाँदी (ग्राममा)',
            'type'  => 'gram'
        ]);
        Nature::create([
            'title' => 'अन्य',
            'type' => 'cash'
        ]);
        
    }
}
