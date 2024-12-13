<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create(['name' => 'काेशी प्रदेश']);
        State::create(['name' => 'मधेश प्रदेश']);
        State::create(['name' => 'बाग्मती प्रदेश']);
        State::create(['name' => 'गण्डकी  प्रदेश']);
        State::create(['name' => 'लुम्बिनी प्रदेश']);
        State::create(['name' => 'कर्णाली प्रदेश']);
        State::create(['name' => 'सुदुरपश्चिम प्रदेश']);
    }
}
