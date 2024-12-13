<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Koshi Province (state_id = 1)
        District::create(['name' => 'भाेजपुर', 'state_id' => 1]);
        District::create(['name' => 'धनकुटा', 'state_id' => 1]);
        District::create(['name' => 'इलाम', 'state_id' => 1]);
        District::create(['name' => 'झापा', 'state_id' => 1]);
        District::create(['name' => 'खोटाङ', 'state_id' => 1]);
        District::create(['name' => 'माेरङ', 'state_id' => 1]);
        District::create(['name' => 'ओखलढुंगा ', 'state_id' => 1]);
        District::create(['name' => 'पांचथर', 'state_id' => 1]);
        District::create(['name' => 'संखुवासभा', 'state_id' => 1]);
        District::create(['name' => 'सोलुखुम्बु', 'state_id' => 1]);
        District::create(['name' => 'सुनसरी', 'state_id' => 1]);
        District::create(['name' => 'ताप्लेजुंग', 'state_id' => 1]);
        District::create(['name' => 'तेह्रथुम', 'state_id' => 1]);
        District::create(['name' => 'उदयपुर', 'state_id' => 1]);

        // Madhesh Province (state_id = 2)
        District::create(['name' => 'पर्सा', 'state_id' => 2]);
        District::create(['name' => 'बारा', 'state_id' => 2]);
        District::create(['name' => 'रौतहट', 'state_id' => 2]);
        District::create(['name' => 'सर्लाही', 'state_id' => 2]);
        District::create(['name' => 'धनुषा', 'state_id' => 2]);
        District::create(['name' => 'सिराहा', 'state_id' => 2]);
        District::create(['name' => 'महोत्तरी', 'state_id' => 2]);
        District::create(['name' => 'सप्तरी', 'state_id' => 2]);

        // Bagmati Province (state_id = 3)
        District::create(['name' => 'सिन्धुली', 'state_id' => 3]);
        District::create(['name' => 'रामेछाप', 'state_id' => 3]);
        District::create(['name' => 'दोलखा', 'state_id' => 3]);
        District::create(['name' => 'भक्तपुर', 'state_id' => 3]);
        District::create(['name' => 'धादिङ्ग', 'state_id' => 3]);
        District::create(['name' => 'काठमाडौँ', 'state_id' => 3]);
        District::create(['name' => 'काभ्रेपलान्चोक', 'state_id' => 3]);
        District::create(['name' => 'ललितपुर', 'state_id' => 3]);
        District::create(['name' => 'नुवाकोट', 'state_id' => 3]);
        District::create(['name' => 'रसुवा', 'state_id' => 3]);
        District::create(['name' => 'सिन्धुपाल्चोक', 'state_id' => 3]);
        District::create(['name' => 'चितवन', 'state_id' => 3]);
        District::create(['name' => 'मकवानपुर', 'state_id' => 3]);

        // Gandaki Province (state_id = 4)
        District::create(['name' => 'बाग्लुङ्ग', 'state_id' => 4]);
        District::create(['name' => 'गोरखा', 'state_id' => 4]);
        District::create(['name' => 'कास्की', 'state_id' => 4]);
        District::create(['name' => 'लम्जुङ्ग', 'state_id' => 4]);
        District::create(['name' => 'मनाङ्ग', 'state_id' => 4]);
        District::create(['name' => 'मुस्तांग', 'state_id' => 4]);
        District::create(['name' => 'म्याग्दी', 'state_id' => 4]);
        District::create(['name' => 'नवलपुर', 'state_id' => 4]);
        District::create(['name' => 'पर्वत', 'state_id' => 4]);
        District::create(['name' => 'स्याङ्गजा', 'state_id' => 4]);
        District::create(['name' => 'तनहूँ', 'state_id' => 4]);

        // Lumbini Province (state_id = 5)
        District::create(['name' => 'कपिलवस्तु', 'state_id' => 5]);
        District::create(['name' => 'परासी', 'state_id' => 5]);
        District::create(['name' => 'रुपन्देही', 'state_id' => 5]);
        District::create(['name' => 'अर्घाखाँची', 'state_id' => 5]);
        District::create(['name' => 'गुल्मी', 'state_id' => 5]);
        District::create(['name' => 'पाल्पा', 'state_id' => 5]);
        District::create(['name' => 'दाङ्ग', 'state_id' => 5]);
        District::create(['name' => 'प्युठान', 'state_id' => 5]);
        District::create(['name' => 'रोल्पा', 'state_id' => 5]);
        District::create(['name' => 'पूर्वी रुकुम', 'state_id' => 5]);
        District::create(['name' => 'वाँके', 'state_id' => 5]);
        District::create(['name' => 'वर्दिया', 'state_id' => 5]);

        // Karnali Province (state_id = 6)
        District::create(['name' => 'पश्चिम रुकुम', 'state_id' => 6]);
        District::create(['name' => 'सल्यान', 'state_id' => 6]);
        District::create(['name' => 'डोल्पा', 'state_id' => 6]);
        District::create(['name' => 'हुम्ला', 'state_id' => 6]);
        District::create(['name' => 'जुम्ला', 'state_id' => 6]);
        District::create(['name' => 'कालिकोट', 'state_id' => 6]);
        District::create(['name' => 'मुगु', 'state_id' => 6]);
        District::create(['name' => 'सुर्खेत', 'state_id' => 6]);
        District::create(['name' => 'दैलेख', 'state_id' => 6]);
        District::create(['name' => 'जाजरकोट', 'state_id' => 6]);

        // Sudurpaschim Province (state_id = 7)
        District::create(['name' => 'कैलाली', 'state_id' => 7]);
        District::create(['name' => 'अछाम', 'state_id' => 7]);
        District::create(['name' => 'डोटी', 'state_id' => 7]);
        District::create(['name' => 'वझाङ्ग', 'state_id' => 7]);
        District::create(['name' => 'वाजुरा', 'state_id' => 7]);
        District::create(['name' => 'कंचनपुर', 'state_id' => 7]);
        District::create(['name' => 'डडेल्धुरा', 'state_id' => 7]);
        District::create(['name' => 'वैतडी', 'state_id' => 7]);
        District::create(['name' => 'दार्चुला', 'state_id' => 7]);


    }
}
