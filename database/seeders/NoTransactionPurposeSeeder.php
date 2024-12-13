<?php

namespace Database\Seeders;

use App\Models\NoTransactionPurpose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoTransactionPurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NoTransactionPurpose::create(['title' => 'अनुचित लेनदेनको परिभाषा भित्र नपर्ने']);
        NoTransactionPurpose::create(['title' => 'आपसी सहमतीमा मिलापत्र गर्न निवेदन फिर्ता']);
        NoTransactionPurpose::create(['title' => 'निवेदकद्वारा निवेदन फिर्ता']);
        NoTransactionPurpose::create(['title' => 'लिनदिन नपर्ने गरी मिलापत्र']);
        NoTransactionPurpose::create(['title' => 'अदालतमा मुद्दा रहेकोमा छलफल गराउँदा सहमती हुन नसकेको']);
        NoTransactionPurpose::create(['title' => 'जग्गा खरिद विक्री सम्बन्धी कारोवार भएको देखिएको']);
        NoTransactionPurpose::create(['title' => 'साहुद्रारा मिनहा गरिएको']);
        NoTransactionPurpose::create(['title' => 'छलफलकै क्रमम रहेको']);
        NoTransactionPurpose::create(['title' => 'नखुलेको']);
        NoTransactionPurpose::create(['title' => 'उपस्थित नभएको']);
        NoTransactionPurpose::create(['title' => 'अन्य']);
        NoTransactionPurpose::create(['title' => 'सावा ब्याज रकम दिने सहमति']);
        NoTransactionPurpose::create(['title' => 'जग्गा फिर्ता पास गरिदिने']);
    }
}
