<?php

namespace Database\Seeders;

use App\Models\Proof;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProofSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proof::create(['title' => 'नगद']);
        Proof::create(['title' => 'चेक']);
        Proof::create(['title' => 'जिन्सी']);
        Proof::create(['title' => 'चेक र नगद दुवै ']);
        Proof::create(['title' => 'अन्य']);

    }
}
