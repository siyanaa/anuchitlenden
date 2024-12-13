<?php

namespace Database\Seeders;

use App\Models\Purpose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Purpose::create(['title' => 'विवाह']);
        Purpose::create(['title' => 'शिक्षा']);
        Purpose::create(['title' => 'उपचार']);
        Purpose::create(['title' => 'वैदेशिक रोजगार']);
        Purpose::create(['title' => 'ऋण तिर्न']);
        Purpose::create(['title' => 'घर निर्माण /जग्गा खरिद']);
        Purpose::create(['title' => 'सवारी साधन खरिद']);
        Purpose::create(['title' => 'जन्म']);
        Purpose::create(['title' => 'मृत्यु']);
        Purpose::create(['title' => 'पास्नी']);
        Purpose::create(['title' => 'बर्तामन्ध']);
        Purpose::create(['title' => 'कर्मकाण्ड']);
        Purpose::create(['title' => 'अन्य']);
    }
}
