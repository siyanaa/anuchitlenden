<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\LocalGovernment;
use Illuminate\Database\Seeder;

class LocalGovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ditrict 1 = Bhojpur
        LocalGovernment::create(['name' => 'भोजपुर नगरपालिका ', 'district_id' => 1]);
        LocalGovernment::create(['name' => 'षडानन्द नगरपालिका', 'district_id' => 1]);
        LocalGovernment::create(['name' => 'हतुवागढ़ी गाउँपालिका', 'district_id' => 1]);
        LocalGovernment::create(['name' => 'रामप्रसाद राइ गाउँपालिका', 'district_id' => 1]);
        LocalGovernment::create(['name' => 'आमचोक गाउँपालिका', 'district_id' => 1]);
        LocalGovernment::create(['name' => 'टेम्केमैयुङ गाउँपालिका', 'district_id' => 1]);
        LocalGovernment::create(['name' => 'अरूण  गाउँपालिका', 'district_id' => 1]);
        LocalGovernment::create(['name' => 'पौवादुङमा गाउँपालिका', 'district_id' => 1]);
        LocalGovernment::create(['name' => 'साल्पासिलिछो गाउँपालिका', 'district_id' => 1]);

        // District 2 = Dhankuta
        LocalGovernment::create(['name' => 'धनकुटा नगरपालिका', 'district_id' => 2]);
        LocalGovernment::create(['name' => 'पख्रिबास नगरपालिका', 'district_id' => 2]);
        LocalGovernment::create(['name' => 'महालक्ष्मी नगरपालिका', 'district_id' => 2]);
        LocalGovernment::create(['name' => 'सागुरीगढी गाउँपालिका', 'district_id' => 2]);
        LocalGovernment::create(['name' => 'चौविसे गाउँपालिका', 'district_id' => 2]);
        LocalGovernment::create(['name' => 'सहिदभुमी गाउँपालिका', 'district_id' => 2]);
        LocalGovernment::create(['name' => 'छथर जोरपाटी गाउँपालिका', 'district_id' => 2]);

        // District 3 = Ilam 
        LocalGovernment::create(['name' => 'इलाम नगरपालिका', 'district_id' => 3]);
        LocalGovernment::create(['name' => 'देउमाइ नगरपालिका', 'district_id' => 3]);
        LocalGovernment::create(['name' => 'माइ नगरपालिका', 'district_id' => 3]);
        LocalGovernment::create(['name' => 'सुर्योदया नगरपालिका', 'district_id' => 3]);
        LocalGovernment::create(['name' => 'फाकफोकथुम गाउँपालिका', 'district_id' => 3]);
        LocalGovernment::create(['name' => 'माईजोगमाई गाउँपालिका', 'district_id' => 3]);
        LocalGovernment::create(['name' => 'चुलाचुली गाउँपालिका', 'district_id' => 3]);
        LocalGovernment::create(['name' => 'रोङ्ग गाउँपालिका', 'district_id' => 3]);
        LocalGovernment::create(['name' => 'माङसेबुङ गाउँपालिका', 'district_id' => 3]);
        LocalGovernment::create(['name' => 'सन्दकपुर गाउँपालिका', 'district_id' => 3]);

        // District 4 = Jhapa 
        LocalGovernment::create(['name' => 'मेचीनगर नगरपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'भद्रपुर नगरपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'विर्तामोड नगरपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'अर्जुनधारा नगरपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'कन्काई नगरपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'शिवशताक्षी नगरपालिका ', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'गौरादह नगरपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'दमक नगरपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'बुद्धशान्ति गाउँपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'हल्दिबारी गाउँपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'कंचनकवाल गाउँपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'बाह्रदशी गाउँपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'झापा गाउँपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'गौरिगंज गाउँपालिका', 'district_id' => 4]);
        LocalGovernment::create(['name' => 'कमल गाउँपालिका', 'district_id' => 4]);

        // District 5 = Khotang 
        LocalGovernment::create(['name' => 'दिक्तेल रुपाकोट मझुवागढी नगरपालिका', 'district_id' => 5]);
        LocalGovernment::create(['name' => 'हलेसी तुवाचुङ नगरपालिका', 'district_id' => 5]);
        LocalGovernment::create(['name' => 'खोटेहाङ गाउँपालिका', 'district_id' => 5]);
        LocalGovernment::create(['name' => 'दिप्रुङ चुइचुम्मा गाउँपालिका', 'district_id' => 5]);
        LocalGovernment::create(['name' => 'ऐसेलुखर्क गाउँपालिका', 'district_id' => 5]);
        LocalGovernment::create(['name' => 'जन्तेढूङ्गा गाउँपालिका', 'district_id' => 5]);
        LocalGovernment::create(['name' => 'केपिलासगढी गाउँपालिका', 'district_id' => 5]);
        LocalGovernment::create(['name' => 'वराहपोखरी गाउँपालिका', 'district_id' => 5]);
        LocalGovernment::create(['name' => 'रावाबेसी गाउँपालिका', 'district_id' => 5]);
        LocalGovernment::create(['name' => 'साकेला गाउँपालिका', 'district_id' => 5]);

        // District 6 = Morang 
        LocalGovernment::create(['name' => 'विराटनगर महानगरपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'सुन्दरहरैचा नगरपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'बेलवारी नगरपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'पथरी शनिश्चरे नगरपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'उर्लाबारी नगरपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'रंगेली नगरपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'लेटांग भोगेटनी नगरपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'रतुवामाई नगरपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'सुनवर्शी नगरपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'केराबारी गाउँपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'मिक्लाजुंग गाउँपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'कानेपोखरी गाउँपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'बुढिगंगा गाउँपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'ग्रामथान गाउँपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'कटहरी गाउँपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'धनपालथान गाउँपालिका', 'district_id' => 6]);
        LocalGovernment::create(['name' => 'जहदा गाउँपालिका', 'district_id' => 6]);

        // District 7 = Okhaldhunga 
        LocalGovernment::create(['name' => 'सिद्धिचरण नगरपालिका', 'district_id' => 7]);
        LocalGovernment::create(['name' => 'चम्पादेवी गाउँपालिका', 'district_id' => 7]);
        LocalGovernment::create(['name' => 'सुनकोशी गाउँपालिका', 'district_id' => 7]);
        LocalGovernment::create(['name' => 'लिखु गाउँपालिका', 'district_id' => 7]);
        LocalGovernment::create(['name' => 'चिसान्खुगढ़ी गाउँपालिका', 'district_id' => 7]);
        LocalGovernment::create(['name' => 'मोलुंग गाउँपालिका', 'district_id' => 7]);
        LocalGovernment::create(['name' => 'खिजिडेम्बा गाउँपालिका', 'district_id' => 7]);
        LocalGovernment::create(['name' => 'मानेभन्ज्यांग गाउँपालिका', 'district_id' => 7]);

        // District 8 = Panchthar
        LocalGovernment::create(['name' => 'फिदिम नगरपालिका', 'district_id' => 8]);
        LocalGovernment::create(['name' => 'हिलिहाङ गाउँपालिका', 'district_id' => 8]);
        LocalGovernment::create(['name' => 'कुम्मायक गाउँपालिका', 'district_id' => 8]);
        LocalGovernment::create(['name' => 'मिक्लाजुंग गाउँपालिका', 'district_id' => 8]);
        LocalGovernment::create(['name' => 'फलेलुंग गाउँपालिका', 'district_id' => 8]);
        LocalGovernment::create(['name' => 'फाल्गुनन्द गाउँपालिका', 'district_id' => 8]);
        LocalGovernment::create(['name' => 'तुम्बेवा गाउँपालिका', 'district_id' => 8]);
        LocalGovernment::create(['name' => 'याङवरक गाउँपालिका', 'district_id' => 8]);

        // District 9 = Sankhuwasabha
        LocalGovernment::create(['name' => 'भोटखोला गाउँपालिका', 'district_id' => 9]);
        LocalGovernment::create(['name' => 'चैनपुर नगरपालिका', 'district_id' => 9]);
        LocalGovernment::create(['name' => 'चिचिला गाउँपालिका', 'district_id' => 9]);
        LocalGovernment::create(['name' => 'धर्मदेवी नगरपालिका', 'district_id' => 9]);
        LocalGovernment::create(['name' => 'खाँदबारी नगरपालिका', 'district_id' => 9]);
        LocalGovernment::create(['name' => 'मादी नगरपालिका', 'district_id' => 9]);
        LocalGovernment::create(['name' => 'मकालु गाउँपालिका', 'district_id' => 9]);
        LocalGovernment::create(['name' => 'पाँचखपन नगरपालिका', 'district_id' => 9]);
        LocalGovernment::create(['name' => 'सभापोखरी गाउँपालिका', 'district_id' => 9]);
        LocalGovernment::create(['name' => 'सिलिचोंग गाउँपालिका', 'district_id' => 9]);
        
        // District 10 = Solukhumbu
        LocalGovernment::create(['name' => 'सोलुदुधकुण्ड नगरपालिका', 'district_id' => 10]);
        LocalGovernment::create(['name' => 'थुलुङ दुधकोशी गाउँपालिका', 'district_id' => 10]);
        LocalGovernment::create(['name' => 'नेचासल्यान गाउँपालिका', 'district_id' => 10]);
        LocalGovernment::create(['name' => 'माप्य दुधकोशी गाउँपालिका', 'district_id' => 10]);
        LocalGovernment::create(['name' => 'महाकुलुङ गाउँपालिका', 'district_id' => 10]);
        LocalGovernment::create(['name' => 'सोताङ गाउँपालिका', 'district_id' => 10]);
        LocalGovernment::create(['name' => 'लिखुपिके गाउँपालिका', 'district_id' => 10]);
        LocalGovernment::create(['name' => 'खुम्बु पासाङल्हमु गाउँपालिका', 'district_id' => 10]);
        
        // District 11 = Sunsari
        LocalGovernment::create(['name' => 'इटहरी उपमहानगरपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'धरान उपमहानगरपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'ईनरुवा नगरपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'दुहवी नगरपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'रामधुनी-बासी नगरपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'वराहक्षेत्र नगरपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'कोशी गाउँपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'गढी गाउँपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'बर्जु गाउँपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'भोक्राहा गाउँपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'हरिनगर गाउँपालिका', 'district_id' => 11]);
        LocalGovernment::create(['name' => 'देवानगंज गाउँपालिका', 'district_id' => 11]);
        
        // District 12 = Taplejung 
        LocalGovernment::create(['name' => 'फुङलिङ नगरपालिका', 'district_id' => 12]);
        LocalGovernment::create(['name' => 'आठराई त्रिवेणी गाउँपालिका', 'district_id' => 12]);
        LocalGovernment::create(['name' => 'सिदिङ्वा गाउँपालिका', 'district_id' => 12]);
        LocalGovernment::create(['name' => 'फक्ताङलुङ गाउँपालिका', 'district_id' => 12]);
        LocalGovernment::create(['name' => 'मिक्वाखोला गाउँपालिका', 'district_id' => 12]);
        LocalGovernment::create(['name' => 'मेरिङदेन गाउँपालिका', 'district_id' => 12]);
        LocalGovernment::create(['name' => 'मैवाखोला गाउँपालिका', 'district_id' => 12]);
        LocalGovernment::create(['name' => 'पाथिभरा याङवरक गाउँपालिका', 'district_id' => 12]);
        LocalGovernment::create(['name' => 'सिरीजङ्घा गाउँपालिका', 'district_id' => 12]);
        
        // District 13 = Terhathum 
        LocalGovernment::create(['name' => 'आठराई गाउँपालिका', 'district_id' => 13]);
        LocalGovernment::create(['name' => 'छथर गाउँपालिका', 'district_id' => 13]);
        LocalGovernment::create(['name' => 'लालीगुराँस नगरपालिका', 'district_id' => 13]);
        LocalGovernment::create(['name' => 'मेन्छयायेम गाउँपालिका', 'district_id' => 13]);
        LocalGovernment::create(['name' => 'म्याङ्ग्लूङ्ग नगरपालिका', 'district_id' => 13]);
        LocalGovernment::create(['name' => 'फेदाप गाउँपालिका', 'district_id' => 13]);
        
        // District 14 = Udayapur
        LocalGovernment::create(['name' => 'त्रियुगा नगरपालिका', 'district_id' => 14]);
        LocalGovernment::create(['name' => 'कटारी नगरपालिका ', 'district_id' => 14]);
        LocalGovernment::create(['name' => 'चौडनडीगढ़ी नगरपालिका ', 'district_id' => 14]);
        LocalGovernment::create(['name' => 'बेलाका नगरपालिका ', 'district_id' => 14]);
        LocalGovernment::create(['name' => 'उदयपुरगढी गाउँपालिका', 'district_id' => 14]);
        LocalGovernment::create(['name' => 'रौतामाई गाउँपालिका', 'district_id' => 14]);
        LocalGovernment::create(['name' => 'ताप्ली गाउँपालिका', 'district_id' => 14]);
        LocalGovernment::create(['name' => 'लिम्चुङ्ग्बुङ गाउँपालिका', 'district_id' => 14]);
        
        // MADHESH PROVINCE
        
        // District 15 = Parsa
        LocalGovernment::create(['name' => 'बिरगंज महानगरपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'बहुदरमाई नगरपालिका ', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'पर्सागढी नगरपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'पोखरिया नगरपालिका ', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'बिन्दबासिनी गाउँपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'धोबीनी गाउँपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'छिपहरमाई गाउँपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'जगरनाथपुर गाउँपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'जिरा भवानी गाउँपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'कालिकामाई गाउँपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'पकाहा मैनपुर गाउँपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'पटेर्वा सुगौली गाउँपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'सखुवा प्रसौनी गाउँपालिका', 'district_id' => 15]);
        LocalGovernment::create(['name' => 'ठोरी गाउँपालिका', 'district_id' => 15]);
        
        // District 16 = Bara
        LocalGovernment::create(['name' => 'कलैया उपमहानगरपालिका ', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'जीतपुर सिमरा उपमहानगरपालिका ', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'कोल्हवी नगरपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'निजगढ नगरपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'महागढीमाई नगरपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'सिम्रौनगढ नगरपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'पचरौता नगरपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'फेटा गाउँपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'विश्रामपुर गाउँपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'प्रसौनी गाउँपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'आदर्श कोतवाल गाउँपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'करैयामाई गाउँपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'देवताल गाउँपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'परवानीपुर गाउँपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'बारागढी गाउँपालिका', 'district_id' => 16]);
        LocalGovernment::create(['name' => 'सुवर्ण गाउँपालिका', 'district_id' => 16]);
        
        // District 17 = Rautahat
        LocalGovernment::create(['name' => 'बौधीमाई नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'बृन्दावन नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'चन्द्रपुर नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'देवाही गोनाही नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'गढीमाई नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'गरुडा नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'गौर नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'गुजरा नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'ईशनाथ नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'कटहरिया नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'माधव नारायण नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'मौलापुर नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'परोहा नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'फतुवाबिजयपुर नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'राजदेवी नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'राजपुर नगरपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'दुर्गा भगवती गाउँपालिका', 'district_id' => 17]);
        LocalGovernment::create(['name' => 'यमुनामाई गाउँपालिका', 'district_id' => 17]);
        
        // District 18 = Sarlahi
        LocalGovernment::create(['name' => 'बागमती नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'बलरा नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'बरहथवा नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'गोडैटा नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'हरिवन नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'हरिपुर नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'हरिपुर्वा नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'ईश्वरपुर नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'कविलासी नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'लालबन्दी नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'मलंगवा नगरपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'बसबरीया गाउँपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'विष्णु गाउँपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'ब्रह्मपुरी गाउँपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'चक्रघट्टा गाउँपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'चन्द्रनगर गाउँपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'धनकौल गाउँपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'कौडेना गाउँपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'पर्सा गाउँपालिका', 'district_id' => 18]);
        LocalGovernment::create(['name' => 'रामनगर गाउँपालिका', 'district_id' => 18]);
        
        // District 19 = Dhanusha
        LocalGovernment::create(['name' => 'जनकपुरधाम उपमहानगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'क्षिरेश्वरनाथ नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'गणेशमान चारनाथ नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'धनुषाधाम नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'नगराइन नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'विदेह नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'मिथिला नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'शहीदनगर नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'सबैला नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'कमला नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'मिथिला बिहारी नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'हंसपुर नगरपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'जनकनन्दिनी गाउँपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'बटेश्वर गाउँपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'मुखियापट्टी मुसहरमिया गाउँपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'लक्ष्मीनिया गाउँपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'औरही गाउँपालिका', 'district_id' => 19]);
        LocalGovernment::create(['name' => 'धनौजी गाउँपालिका', 'district_id' => 19]);
        
        // District 20 = Siraha 
        LocalGovernment::create(['name' => 'लहान नगरपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'धनगढीमाई नगरपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'सिरहा नगरपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'गोलबजार नगरपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'मिर्चैयाँ नगरपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'कल्याणपुर नगरपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'कर्जन्हा नगरपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'सुखीपुर नगरपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'भगवानपुर गाउँपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'औरही गाउँपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'विष्णुपुर गाउँपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'बरियारपट्टी गाउँपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'लक्ष्मीपुर पतारी गाउँपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'नरहा गाउँपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'सखुवानान्कारकट्टी गाउँपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'अर्नमा गाउँपालिका', 'district_id' => 20]);
        LocalGovernment::create(['name' => 'नवराजपुर गाउँपालिका', 'district_id' => 20]);
        
        // District 21 = Mahottari
        LocalGovernment::create(['name' => 'औरही नगरपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'बलवा नगरपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'बर्दिबास नगरपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'भँगाहा नगरपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'गौशाला नगरपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'जलेश्वर नगरपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'लोहरपट्टी नगरपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'मनरा शिसवा नगरपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'मटिहानी नगरपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'रामगोपालपुर नगरपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'एकडारा गाउँपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'महोत्तरी गाउँपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'पिपरा गाउँपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'साम्सी गाउँपालिका', 'district_id' => 21]);
        LocalGovernment::create(['name' => 'सोनमा गाउँपालिका', 'district_id' => 21]);
        
        // District 22 = Saptari
        LocalGovernment::create(['name' => 'बोदेबरसाईन नगरपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'डाक्नेश्वरी नगरपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'हनुमाननगर कङ्‌कालिनी नगरपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'कञ्चनरुप नगरपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'खडक नगरपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'शम्भुनाथ नगरपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'सप्तकोशी नगरपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'सुरुङ्‍गा नगरपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'राजविराज नगरपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'अग्निसाइर कृष्णासवरन गाउँपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'बलान-बिहुल गाउँपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'राजगढ गाँउपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'बिष्णुपुर गाउँपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'छिन्नमस्ता गाउँपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'महादेवा गाउँपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'रुपनी गाउँपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'तिलाठी कोईलाडी गाउँपालिका', 'district_id' => 22]);
        LocalGovernment::create(['name' => 'तिरहुत गाउँपालिका', 'district_id' => 22]);
        
        // District 23 = Sindhuli
        LocalGovernment::create(['name' => 'सुनकोशी गाउँपालिका', 'district_id' => 23]);
        LocalGovernment::create(['name' => 'हरिहरपुरगढी गाउँपालिका', 'district_id' => 23]);
        LocalGovernment::create(['name' => 'तिनपाटन गाउँपालिका', 'district_id' => 23]);
        LocalGovernment::create(['name' => 'मरिण गाउँपालिका', 'district_id' => 23]);
        LocalGovernment::create(['name' => 'गोलन्जर गाउँपालिका', 'district_id' => 23]);
        LocalGovernment::create(['name' => 'फिक्कल गाउँपालिका', 'district_id' => 23]);
        LocalGovernment::create(['name' => 'घ्याङलेख गाउँपालिका', 'district_id' => 23]);
        
        // District 24 = Ramechhap
        LocalGovernment::create(['name' => 'मन्थली नगरपालिका', 'district_id' => 24]);
        LocalGovernment::create(['name' => 'रामेछाप नगरपालिका', 'district_id' => 24]);
        LocalGovernment::create(['name' => 'उमाकुण्ड गाउँपालिका', 'district_id' => 24]);
        LocalGovernment::create(['name' => 'खाँडादेवी गाउँपालिका', 'district_id' => 24]);
        LocalGovernment::create(['name' => 'दोरम्बा गाउँपालिका', 'district_id' => 24]);
        LocalGovernment::create(['name' => 'गोकुलगङ्गा गाउँपालिका', 'district_id' => 24]);
        LocalGovernment::create(['name' => 'लिखु तामाकोशी गाउँपालिका', 'district_id' => 24]);
        LocalGovernment::create(['name' => 'सुनापती गाउँपालिका', 'district_id' => 24]);
        
        // District 25 = Dolakha
        LocalGovernment::create(['name' => 'भिमेश्वर नगरपालिका', 'district_id' => 25]);
        LocalGovernment::create(['name' => 'जिरी नगरपालिका', 'district_id' => 25]);
        LocalGovernment::create(['name' => 'कालिन्चोक गाउँपालिका', 'district_id' => 25]);
        LocalGovernment::create(['name' => 'मेलुङ्ग गाउँपालिका', 'district_id' => 25]);
        LocalGovernment::create(['name' => 'विगु गाउँपालिका', 'district_id' => 25]);
        LocalGovernment::create(['name' => 'गौरीशङ्कर गाउँपालिका', 'district_id' => 25]);
        LocalGovernment::create(['name' => 'वैतेश्वर गाउँपालिका', 'district_id' => 25]);
        LocalGovernment::create(['name' => 'शैलुङ्ग गाउँपालिका', 'district_id' => 25]);
        LocalGovernment::create(['name' => 'तामाकोशी गाउँपालिका', 'district_id' => 25]);
        
        // District 26 = Bhaktapur 
        LocalGovernment::create(['name' => 'भक्तपुर नगरपालिका', 'district_id' => 26]);
        LocalGovernment::create(['name' => 'चाँगुनारायण नगरपालिका', 'district_id' => 26]);
        LocalGovernment::create(['name' => 'मध्यपुर ठिमि नगरपालिका', 'district_id' => 26]);
        LocalGovernment::create(['name' => 'सुर्यविनायक नगरपालिका', 'district_id' => 26]);
        
        // District 27 = Dhading 
        LocalGovernment::create(['name' => 'धुनीबेंशी नगरपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'निलकण्ठ नगरपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'खनियाबास गाउँपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'गजुरी गाउँपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'गल्छी गाउँपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'गङ्गाजमुना गाउँपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'ज्वालामूखी गाउँपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'थाक्रे गाउँपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'नेत्रावती डबजोङ गाउँपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'बेनीघाट रोराङ्ग गाउँपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'रुवी भ्याली गाउँपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'सिद्धलेक गाउँपालिका', 'district_id' => 27]);
        LocalGovernment::create(['name' => 'त्रिपुरासुन्दरी गाउँपालिका', 'district_id' => 27]);
        
        // District 28 = Kathmandu 
        LocalGovernment::create(['name' => 'काठमांडाै महानगरपालिका', 'district_id' => 28]);
        LocalGovernment::create(['name' => 'बुढानिलकण्ठ नगरपालिका', 'district_id' => 28]);
        LocalGovernment::create(['name' => 'तार्केश्वर नगरपालिका', 'district_id' => 28]);
        LocalGovernment::create(['name' => 'गाेकर्णेश्वर नगरपालिका', 'district_id' => 28]);
        LocalGovernment::create(['name' => 'चन्द्रागिरी नगरपालिका', 'district_id' => 28]);
        LocalGovernment::create(['name' => 'टाेखा नगरपालिका', 'district_id' => 28]);
        LocalGovernment::create(['name' => 'कागेश्वरी नगरपालिका', 'district_id' => 28]);
        LocalGovernment::create(['name' => 'नागार्जुन नगरपालिका', 'district_id' => 28]);
        LocalGovernment::create(['name' => 'किर्तिपुर नगरपालिका', 'district_id' => 28]);
        LocalGovernment::create(['name' => 'दक्षिणकाली नगरपालिका', 'district_id' => 28]);
        LocalGovernment::create(['name' => 'शंकरपरु नगरपालिका', 'district_id' => 28]);
        
        // District 29 = Kavrepalanchok
        LocalGovernment::create(['name' => 'धुलिखेल नगरपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'बनेपा नगरपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'पनौती नगरपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'पाँचखाल नगरपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'नमोबुद्ध नगरपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'मण्डनदेउपुर नगरपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'खानीखोला गाउँपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'चौंरी देउराली गाउँपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'तेमाल गाउँपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'बेथानचोक गाउँपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'भुम्लु गाउँपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'महाभारत गाउँपालिका', 'district_id' => 29]);
        LocalGovernment::create(['name' => 'रोशी गाउँपालिका', 'district_id' => 29]);
        
        // District 30 = Lalitpur
        LocalGovernment::create(['name' => 'ललितपुर महानगरपालिका', 'district_id' => 30]);
        LocalGovernment::create(['name' => 'महालक्ष्मी नगरपालिका', 'district_id' => 30]);
        LocalGovernment::create(['name' => 'गोदावरी नगरपालिका', 'district_id' => 30]);
        LocalGovernment::create(['name' => 'कोन्ज्योसोम गाउँपालिका', 'district_id' => 30]);
        LocalGovernment::create(['name' => 'बाग्मति गाउँपालिका', 'district_id' => 30]);
        LocalGovernment::create(['name' => 'महाङ्काल गाउँपालिका', 'district_id' => 30]);
        
        // District 31 = Nuwakot
        LocalGovernment::create(['name' => 'विदुर नगरपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'बेलकोटगढी नगरपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'ककनी गाउँपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'पञ्चकन्या गाउँपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'लिखु गाउँपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'दुप्चेश्वर गाउँपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'शिवपुरी गाउँपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'तादी गाउँपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'सुर्यगढी गाउँपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'तारकेश्वर गाउँपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'किस्पाङ गाउँपालिका', 'district_id' => 31]);
        LocalGovernment::create(['name' => 'म्यागङ गाउँपालिका', 'district_id' => 31]);
        
        // District 32 = Rasuwa
        LocalGovernment::create(['name' => 'उत्तरगया गाउँपालिका', 'district_id' => 32]);
        LocalGovernment::create(['name' => 'कालिका गाउँपालिका', 'district_id' => 32]);
        LocalGovernment::create(['name' => 'गाेसाइकुण्ड गाउँपालिका', 'district_id' => 32]);
        LocalGovernment::create(['name' => 'नाैकुण्ड गाउँपालिका', 'district_id' => 32]);
        LocalGovernment::create(['name' => 'आमाछोदिन्ग्मो गाउँपालिका', 'district_id' => 32]);
        
        // District 33 = Sindhupalchok
        LocalGovernment::create(['name' => 'चौतारा साँगाचोकगढी नगरपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'बाह्रविसे नगरपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'मेलम्ची नगरपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'बलेफी गाउँपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'सुनकोशी गाउँपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'इन्द्रावती गाउँपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'जुगल गाउँपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'पाँचपोखरी थाङपाल गाउँपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'भोटेकोशी गाउँपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'लिसंखु पाखर गाउँपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'हेलम्बु गाउँपालिका', 'district_id' => 33]);
        LocalGovernment::create(['name' => 'त्रिपुरासुन्दरी गाउँपालिका', 'district_id' => 33]);
        
        // District 34 = Chitwan
        LocalGovernment::create(['name' => 'भरतपुर महानगरपालिका', 'district_id' => 34]);
        LocalGovernment::create(['name' => 'कालिका नगरपालिका', 'district_id' => 34]);
        LocalGovernment::create(['name' => 'खैरहनी नगरपालिका', 'district_id' => 34]);
        LocalGovernment::create(['name' => 'मादी नगरपालिका', 'district_id' => 34]);
        LocalGovernment::create(['name' => 'रत्ननगर नगरपालिका', 'district_id' => 34]);
        LocalGovernment::create(['name' => 'राप्ती नगरपालिका', 'district_id' => 34]);
        LocalGovernment::create(['name' => 'इक्षाकामना गाँउपालिका', 'district_id' => 34]);
        
        // District 35 = Makwanpur
        LocalGovernment::create(['name' => 'हेटौडा उपमहानगरपालिका', 'district_id' => 35]);
        LocalGovernment::create(['name' => 'थाहा नगरपालिका', 'district_id' => 35]);
        LocalGovernment::create(['name' => 'भीमफेदी गाउँपालिका', 'district_id' => 35]);
        LocalGovernment::create(['name' => 'मकवानपुरगढी गाउँपालिका', 'district_id' => 35]);
        LocalGovernment::create(['name' => 'मनहरी गाउँपालिका', 'district_id' => 35]);
        LocalGovernment::create(['name' => 'राक्सिराङ्ग गाउँपालिका', 'district_id' => 35]);
        LocalGovernment::create(['name' => 'बकैया गाउँपालिका', 'district_id' => 35]);
        LocalGovernment::create(['name' => 'बाग्मति गाउँपालिका', 'district_id' => 35]);
        LocalGovernment::create(['name' => 'कैलाश गाउँपालिका', 'district_id' => 35]);
        LocalGovernment::create(['name' => 'ईन्द्र सरोवर गाउँपालिका', 'district_id' => 35]);
        
        // Gandaki Province
        // District 36 = Baglung
        LocalGovernment::create(['name' => 'बागलुङ नगरपालिका', 'district_id' => 36]);
        LocalGovernment::create(['name' => 'ढोरपाटन नगरपालिका', 'district_id' => 36]);
        LocalGovernment::create(['name' => 'गल्कोट नगरपालिका', 'district_id' => 36]);
        LocalGovernment::create(['name' => 'जैमूनी नगरपालिका', 'district_id' => 36]);
        LocalGovernment::create(['name' => 'वरेङ गाउँपालिका', 'district_id' => 36]);
        LocalGovernment::create(['name' => 'काठेखोला गाउँपालिका', 'district_id' => 36]);
        LocalGovernment::create(['name' => 'तमानखोला गाउँपालिका', 'district_id' => 36]);
        LocalGovernment::create(['name' => 'ताराखोला गाउँपालिका', 'district_id' => 36]);
        LocalGovernment::create(['name' => 'निसीखोला गाउँपालिका', 'district_id' => 36]);
        LocalGovernment::create(['name' => 'वडिगाड गाउँपालिका', 'district_id' => 36]);
        
        // District 37 = Gorkha
        LocalGovernment::create(['name' => 'गोरखा नगरपालिका', 'district_id' => 37]);
        LocalGovernment::create(['name' => 'पालुङटार नगरपालिका', 'district_id' => 37]);
        LocalGovernment::create(['name' => 'सुलिकाेट गाँउपालिका', 'district_id' => 37]);
        LocalGovernment::create(['name' => 'सिरानचोक गाउँपालिका', 'district_id' => 37]);
        LocalGovernment::create(['name' => 'अजिरकोट गाउँपालिका', 'district_id' => 37]);
        LocalGovernment::create(['name' => 'चुम नुव्री गाउँपालिका', 'district_id' => 37]);
        LocalGovernment::create(['name' => 'धार्चे गाउँपालिका', 'district_id' => 37]);
        LocalGovernment::create(['name' => 'भिमसेनथापा गाउँपालिका', 'district_id' => 37]);
        LocalGovernment::create(['name' => 'शहिद लखन गाउँपालिका', 'district_id' => 37]);
        LocalGovernment::create(['name' => 'आरूघाट गाउँपालिका', 'district_id' => 37]);
        LocalGovernment::create(['name' => 'गण्डकी गाउँपालिका', 'district_id' => 37]);
        
        // DIstrict 38 = Kaski
        LocalGovernment::create(['name' => 'पोखरा महानगरपालिका', 'district_id' => 38]);
        LocalGovernment::create(['name' => 'अन्नपुर्ण गाउँपालिका', 'district_id' => 38]);
        LocalGovernment::create(['name' => 'माछापुछ्रे गाउँपालिका', 'district_id' => 38]);
        LocalGovernment::create(['name' => 'मादी गाउँपालिका', 'district_id' => 38]);
        LocalGovernment::create(['name' => 'रूपा गाउँपालिका', 'district_id' => 38]);
        
          // District 39 = Lamjhung
          LocalGovernment::create(['name' => 'बेसीशहर नगरपालिका ', 'district_id' => 39]);
          LocalGovernment::create(['name' => 'दोर्दी गाउँपालिका', 'district_id' => 39]);
          LocalGovernment::create(['name' => 'दूधपोखरी गाउँपालिका', 'district_id' => 39]);
          LocalGovernment::create(['name' => 'क्व्होलासोथार गाउँपालिका', 'district_id' => 39]);
          LocalGovernment::create(['name' => 'मध्यनेपाल नगरपालिका ', 'district_id' => 39]);
          LocalGovernment::create(['name' => 'मर्स्याङदी गाउँपालिका', 'district_id' => 39]);
          LocalGovernment::create(['name' => 'रार्इनास नगरपालिका ', 'district_id' => 39]);
          LocalGovernment::create(['name' => 'सुन्दरबजार नगरपालिका ', 'district_id' => 39]);
          
          // District 40 = Manang
          LocalGovernment::create(['name' => 'चामे गाउँपालिका', 'district_id' => 40]);
          LocalGovernment::create(['name' => 'नासोँ गाउँपालिका', 'district_id' => 40]);
          LocalGovernment::create(['name' => 'नार्पा भूमि  गाउँपालिका', 'district_id' => 40]);
          LocalGovernment::create(['name' => 'मनाङ डिस्याङ गाउँपालिका', 'district_id' => 40]);
          
          // District 41 = Mustang 
          LocalGovernment::create(['name' => 'घरपझोङ गाउँपालिका', 'district_id' => 41]);
          LocalGovernment::create(['name' => 'थासाङ गाउँपालिका', 'district_id' => 41]);
          LocalGovernment::create(['name' => 'बारागुङ मुक्तिक्षेत्र गाउँपालिका', 'district_id' => 41]);
          LocalGovernment::create(['name' => 'लोमन्थाङ गाउँपालिका', 'district_id' => 41]);
          LocalGovernment::create(['name' => 'लो-थेकर दामोदरकुण्ड गाउँपालिका', 'district_id' => 41]);
          
          // District 42 = Myagdi
          LocalGovernment::create(['name' => 'बेनी नगरपालिका ', 'district_id' => 42]);
          LocalGovernment::create(['name' => 'अन्नपुर्ण गाउँपालिका', 'district_id' => 42]);
          LocalGovernment::create(['name' => 'धवलागिरी गाउँपालिका', 'district_id' => 42]);
          LocalGovernment::create(['name' => 'मंगला गाउँपालिका', 'district_id' => 42]);
          LocalGovernment::create(['name' => 'मालिका गाउँपालिका', 'district_id' => 42]);
          LocalGovernment::create(['name' => 'रघुगंगा गाउँपालिका', 'district_id' => 42]);
          
          // District 43 = Nawalpur
          LocalGovernment::create(['name' => 'कावासोती नगरपालिका ', 'district_id' => 43]);
          LocalGovernment::create(['name' => 'गैडाकोट नगरपालिका', 'district_id' => 43]);
          LocalGovernment::create(['name' => 'देवचुली नगरपालिका ', 'district_id' => 43]);
          LocalGovernment::create(['name' => 'मध्यविन्दु नगरपालिका', 'district_id' => 43]);
          LocalGovernment::create(['name' => 'बौदीकाली गाउँपालिका', 'district_id' => 43]);
          LocalGovernment::create(['name' => 'बुलिङटार गाउँपालिका', 'district_id' => 43]);
          LocalGovernment::create(['name' => 'विनयी त्रिवेणी गाउँपालिका', 'district_id' => 43]);
          LocalGovernment::create(['name' => 'हुप्सेकोट गाउँपालिका', 'district_id' => 43]);
          
          // District 44 = Parbat
          LocalGovernment::create(['name' => 'कुश्मा नगरपालिका ', 'district_id' => 44]);
          LocalGovernment::create(['name' => 'फलेवास नगरपालिका ', 'district_id' => 44]);
          LocalGovernment::create(['name' => 'जलजला गाउँपालिका', 'district_id' => 44]);
          LocalGovernment::create(['name' => 'पैयूं गाउँपालिका', 'district_id' => 44]);
          LocalGovernment::create(['name' => 'महाशिला गाउँपालिका', 'district_id' => 44]);
          LocalGovernment::create(['name' => 'मोदी गाउँपालिका', 'district_id' => 44]);
          LocalGovernment::create(['name' => 'विहादी गाउँपालिका', 'district_id' => 44]);
          
          // District 45 = Syangja
          LocalGovernment::create(['name' => 'गल्याङ नगरपालिका ', 'district_id' => 45]);
          LocalGovernment::create(['name' => 'चापाकोट नगरपालिका ', 'district_id' => 45]);
          LocalGovernment::create(['name' => 'पुतलीबजार नगरपालिका ', 'district_id' => 45]);
          LocalGovernment::create(['name' => 'भीरकोट नगरपालिका ', 'district_id' => 45]);
          LocalGovernment::create(['name' => 'वालिङ नगरपालिका ', 'district_id' => 45]);
          LocalGovernment::create(['name' => 'अर्जुन चौपारी गाउँपालिका', 'district_id' => 45]);
          LocalGovernment::create(['name' => 'आँधीखोला गाउँपालिका', 'district_id' => 45]);
          LocalGovernment::create(['name' => 'कालीगण्डकी गाउँपालिका', 'district_id' => 45]);
          LocalGovernment::create(['name' => 'फेदीखोला गाउँपालिका', 'district_id' => 45]);
          LocalGovernment::create(['name' => 'हरिनास गाउँपालिका', 'district_id' => 45]);
          LocalGovernment::create(['name' => 'विरुवा गाउँपालिका', 'district_id' => 45]);
          
          // District 46 = Tanahun
          LocalGovernment::create(['name' => 'भानु नगरपालिका', 'district_id' => 46]);
          LocalGovernment::create(['name' => 'भिमाद नगरपालिका', 'district_id' => 46]);
          LocalGovernment::create(['name' => 'व्यास नगरपालिका', 'district_id' => 46]);
          LocalGovernment::create(['name' => 'शुक्लागण्डकी नगरपालिका', 'district_id' => 46]);
          LocalGovernment::create(['name' => 'आँबुखैरेनी गाउँपालिका', 'district_id' => 46]);
          LocalGovernment::create(['name' => 'देवघाट गाउँपालिका', 'district_id' => 46]);
          LocalGovernment::create(['name' => 'बन्दिपुर गाउँपालिका', 'district_id' => 46]);
          LocalGovernment::create(['name' => 'ऋषिङ्ग गाउँपालिका', 'district_id' => 46]);
          LocalGovernment::create(['name' => 'घिरिङ गाउँपालिका', 'district_id' => 46]);
          LocalGovernment::create(['name' => 'म्याग्दे गाउँपालिका', 'district_id' => 46]);
          
          // Lumbini Province
          // District 47 = Kapilvastu
          LocalGovernment::create(['name' => 'कपिलवस्तु नगरपालिका ', 'district_id' => 47]);
          LocalGovernment::create(['name' => 'बाणगंगा नगरपालिका ', 'district_id' => 47]);
          LocalGovernment::create(['name' => 'बुद्धभुमी नगरपालिका ', 'district_id' => 47]);
          LocalGovernment::create(['name' => 'शिवराज नगरपालिका ', 'district_id' => 47]);
          LocalGovernment::create(['name' => 'कृष्णनगर नगरपालिका ', 'district_id' => 47]);
          LocalGovernment::create(['name' => 'महाराजगंज नगरपालिका ', 'district_id' => 47]);
          LocalGovernment::create(['name' => 'मायादेवी गाउँपालिका', 'district_id' => 47]);
          LocalGovernment::create(['name' => 'यसोधरा गाउँपालिका', 'district_id' => 47]);
          LocalGovernment::create(['name' => 'शुद्धोधन गाउँपालिका', 'district_id' => 47]);
          LocalGovernment::create(['name' => 'विजयनगर गाउँपालिका', 'district_id' => 47]);
          
          //District 48 = Parasi
          LocalGovernment::create(['name' => 'बर्दघाट नगरपालिका ', 'district_id' => 48]);
          LocalGovernment::create(['name' => 'रामग्राम नगरपालिका ', 'district_id' => 48]);
          LocalGovernment::create(['name' => 'सुनवल नगरपालिका ', 'district_id' => 48]);
          LocalGovernment::create(['name' => 'सुस्ता गाउँपालिका', 'district_id' => 48]);
          LocalGovernment::create(['name' => 'पाल्हीनन्दन गाउँपालिका', 'district_id' => 48]);
          LocalGovernment::create(['name' => 'प्रतापपुर गाउँपालिका', 'district_id' => 48]);
          LocalGovernment::create(['name' => 'सरावल गाउँपालिका', 'district_id' => 48]);
          
          // District 49 = Rupandehi
          LocalGovernment::create(['name' => 'बुटवल उपमहानगरपालिका ', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'देवदह नगरपालिका ', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'लुम्बिनी सांस्कृतिक नगरपालिका ', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'सैनामैना नगरपालिका ', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'सिद्धार्थनगर नगरपालिका ', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'तिलोत्तमा नगरपालिका ', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'गैडहवा गाउँपालिका', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'कञ्चन गाउँपालिका', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'कोटहीमाई गाउँपालिका', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'मर्चवारी गाउँपालिका', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'मायादेवी गाउँपालिका', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'ओमसतीया गाउँपालिका', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'रोहिणी गाउँपालिका', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'सम्मरीमाई गाउँपालिका', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'सियारी गाउँपालिका', 'district_id' => 49]);
          LocalGovernment::create(['name' => 'शुद्धोधन गाउँपालिका', 'district_id' => 49]);
          
          // District 50 = Arghakhanchi
          LocalGovernment::create(['name' => 'सन्धिखर्क नगरपालिका ', 'district_id' => 50]);
          LocalGovernment::create(['name' => 'शितगंगा नगरपालिका ', 'district_id' => 50]);
          LocalGovernment::create(['name' => 'भूमिकास्थान नगरपालिका ', 'district_id' => 50]);
          LocalGovernment::create(['name' => 'छत्रदेव गाउँपालिका', 'district_id' => 50]);
          LocalGovernment::create(['name' => 'पाणिनी गाउँपालिका', 'district_id' => 50]);
          LocalGovernment::create(['name' => 'मालारानी गाउँपालिका', 'district_id' => 50]);
          
          // District 51 = Gulmi 
          LocalGovernment::create(['name' => 'मुसिकोट नगरपालिका ', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'रेसुङ्गा नगरपालिका ', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'ईस्मा गाउँपालिका', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'कालीगण्डकी गाउँपालिका', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'गुल्मीदरवार गाउँपालिका', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'सत्यवती गाउँपालिका', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'चन्द्रकोट गाउँपालिका', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'रुरुक्षेत्र गाउँपालिका', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'छत्रकोट गाउँपालिका', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'धुर्कोट गाउँपालिका', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'मदाने गाउँपालिका', 'district_id' => 51]);
          LocalGovernment::create(['name' => 'मालिका गाउँपालिका', 'district_id' => 51]);
          
          // District 52 = Palpa
          LocalGovernment::create(['name' => 'तानसेन नगरपालिका ', 'district_id' => 52]);
          LocalGovernment::create(['name' => 'रामपुर नगरपालिका ', 'district_id' => 52]);
          LocalGovernment::create(['name' => 'रैनादेवी छहरा गाउँपालिका', 'district_id' => 52]);
          LocalGovernment::create(['name' => 'रिब्दीकोट गाउँपालिका', 'district_id' => 52]);
          LocalGovernment::create(['name' => 'बगनासकाली  गाउँपालिका', 'district_id' => 52]);
          LocalGovernment::create(['name' => 'रम्भा गाउँपालिका', 'district_id' => 52]);
          LocalGovernment::create(['name' => 'पूर्वखोला गाउँपालिका', 'district_id' => 52]);
          LocalGovernment::create(['name' => 'निस्दी गाउँपालिका', 'district_id' => 52]);
          LocalGovernment::create(['name' => 'माथागढी गाउँपालिका', 'district_id' => 52]);
          LocalGovernment::create(['name' => 'तिनाउ गाउँपालिका', 'district_id' => 52]);
          
          // District 53 = Dang 
          LocalGovernment::create(['name' => 'घोराही उपमहानगरपालिका ', 'district_id' => 53]);
          LocalGovernment::create(['name' => 'तुल्सीपुर उपमहानगरपालिका ', 'district_id' => 53]);
          LocalGovernment::create(['name' => 'लमही नगरपालिका ', 'district_id' => 53]);
          LocalGovernment::create(['name' => 'गढवा गाउँपालिका', 'district_id' => 53]);
          LocalGovernment::create(['name' => 'राजपुर गाउँपालिका', 'district_id' => 53]);
          LocalGovernment::create(['name' => 'शान्तिनगर गाउँपालिका', 'district_id' => 53]);
          LocalGovernment::create(['name' => 'राप्ती गाउँपालिका', 'district_id' => 53]);
          LocalGovernment::create(['name' => 'वंगलाचुली गाउँपालिका', 'district_id' => 53]);
          LocalGovernment::create(['name' => 'दंगीशरण गाउँपालिका', 'district_id' => 53]);
          LocalGovernment::create(['name' => 'बबई गाउँपालिका', 'district_id' => 53]);
          
          // District 54 = Pyuthan
          LocalGovernment::create(['name' => 'प्यूठान नगरपालिका ', 'district_id' => 54]);
          LocalGovernment::create(['name' => 'स्वर्गद्वारी नगरपालिका ', 'district_id' => 54]);
          LocalGovernment::create(['name' => 'गौमुखी गाउँपालिका', 'district_id' => 54]);
          LocalGovernment::create(['name' => 'माण्डवी गाउँपालिका', 'district_id' => 54]);
          LocalGovernment::create(['name' => 'सरुमारानी गाउँपालिका', 'district_id' => 54]);
          LocalGovernment::create(['name' => 'मल्लरानी गाउँपालिका', 'district_id' => 54]);
          LocalGovernment::create(['name' => 'नौबहिनी गाउँपालिका', 'district_id' => 54]);
          LocalGovernment::create(['name' => 'झिमरुक गाउँपालिका', 'district_id' => 54]);
          LocalGovernment::create(['name' => 'ऐरावती गाउँपालिका', 'district_id' => 54]);
          
          // District 55 = Rolpa 
          LocalGovernment::create(['name' => 'रोल्पा नगरपालिका ', 'district_id' => 55]);
          LocalGovernment::create(['name' => 'रुन्टीगढी गाउँपालिका', 'district_id' => 55]);
          LocalGovernment::create(['name' => 'त्रिवेणी गाउँपालिका', 'district_id' => 55]);
          LocalGovernment::create(['name' => 'सुनिल स्मृति गाउँपालिका', 'district_id' => 55]);
          LocalGovernment::create(['name' => 'लुङ्ग्री गाउँपालिका', 'district_id' => 55]);
          LocalGovernment::create(['name' => 'सुनछहरी गाउँपालिका', 'district_id' => 55]);
          LocalGovernment::create(['name' => 'थवाङ गाउँपालिका', 'district_id' => 55]);
          LocalGovernment::create(['name' => 'माडी गाउँपालिका', 'district_id' => 55]);
          LocalGovernment::create(['name' => 'गंगादेव गाउँपालिका', 'district_id' => 55]);
          LocalGovernment::create(['name' => 'परिवर्तन गाउँपालिका', 'district_id' => 55]);
          
          // District 56 = East Rukum
          LocalGovernment::create(['name' => 'भूमे गाउँपालिका', 'district_id' => 56]);
          LocalGovernment::create(['name' => 'पुथा उत्तरगंगा गाउँपालिका', 'district_id' => 56]);
          LocalGovernment::create(['name' => 'सिस्ने गाउँपालिका', 'district_id' => 56]);
          
          // District 57 = Banke
          LocalGovernment::create(['name' => 'नेपालगंज उपमहानगरपालिका ', 'district_id' => 57]);
          LocalGovernment::create(['name' => 'कोहलपुर नगरपालिका ', 'district_id' => 57]);
          LocalGovernment::create(['name' => 'राप्ती सोनारी गाउँपालिका', 'district_id' => 57]);
          LocalGovernment::create(['name' => 'नरैनापुर गाउँपालिका', 'district_id' => 57]);
          LocalGovernment::create(['name' => 'डुडुवा गाउँपालिका', 'district_id' => 57]);
          LocalGovernment::create(['name' => 'जानकी गाउँपालिका', 'district_id' => 57]);
          LocalGovernment::create(['name' => 'खजुरा गाउँपालिका', 'district_id' => 57]);
          LocalGovernment::create(['name' => 'वैजनाथ गाउँपालिका', 'district_id' => 57]);
          
          // District 58 = Bardiya
          LocalGovernment::create(['name' => 'गुलरिया नगरपालिका ', 'district_id' => 58]);
          LocalGovernment::create(['name' => 'राजापुर नगरपालिका ', 'district_id' => 58]);
          LocalGovernment::create(['name' => 'मधुवन नगरपालिका', 'district_id' => 58]);
          LocalGovernment::create(['name' => 'ठाकुरबाबा नगरपालिका ', 'district_id' => 58]);
          LocalGovernment::create(['name' => 'बाँसगढी नगरपालिका ', 'district_id' => 58]);
          LocalGovernment::create(['name' => 'बारबर्दिया नगरपालिका ', 'district_id' => 58]);
          LocalGovernment::create(['name' => 'बढैयाताल गाउँपालिका', 'district_id' => 58]);
          LocalGovernment::create(['name' => 'गेरुवा गाउँपालिका', 'district_id' => 58]);
          
          // Karnali Province
          // District 59 = West Rukum
          LocalGovernment::create(['name' => 'मुसिकोट नगरपालिका', 'district_id' => 59]);
          LocalGovernment::create(['name' => 'चौरजहारी नगरपालिका', 'district_id' => 59]);
          LocalGovernment::create(['name' => 'आठबिसकोट नगरपालिका', 'district_id' => 59]);
          LocalGovernment::create(['name' => 'बाँफिकोट गाउँपालिका', 'district_id' => 59]);
          LocalGovernment::create(['name' => 'त्रिवेणी गाउँपालिका', 'district_id' => 59]);
          LocalGovernment::create(['name' => 'सानीभेरी गाउँपालिका', 'district_id' => 59]);
          
          // District 60 = Salyan 
          LocalGovernment::create(['name' => 'शारदा नगरपालिका ', 'district_id' => 60]);
          LocalGovernment::create(['name' => 'बागचौर नगरपालिका ', 'district_id' => 60]);
          LocalGovernment::create(['name' => 'बनगाड कुपिण्डे नगरपालिका ', 'district_id' => 60]);
          LocalGovernment::create(['name' => 'कालीमाटी गाउँपालिका', 'district_id' => 60]);
          LocalGovernment::create(['name' => 'त्रिवेणी गाउँपालिका', 'district_id' => 60]);
          LocalGovernment::create(['name' => 'कपुरकोट गाउँपालिका', 'district_id' => 60]);
          LocalGovernment::create(['name' => 'छत्रेश्वरी गाउँपालिका', 'district_id' => 60]);
          LocalGovernment::create(['name' => 'कुमाख गाउँपालिका', 'district_id' => 60]);
          LocalGovernment::create(['name' => 'सिद्ध कुमाख गाउँपालिका', 'district_id' => 60]);
          LocalGovernment::create(['name' => 'दार्मा गाउँपालिका', 'district_id' => 60]);
          
          // District 61 = Dolpa 
          LocalGovernment::create(['name' => 'ठूली भेरी नगरपालिका ', 'district_id' => 61]);
          LocalGovernment::create(['name' => 'त्रिपुरासुन्दरी नगरपालिका ', 'district_id' => 61]);
          LocalGovernment::create(['name' => 'डोल्पो बुद्ध गाउँपालिका', 'district_id' => 61]);
          LocalGovernment::create(['name' => 'शे फोक्सुन्डो गाउँपालिका', 'district_id' => 61]);
          LocalGovernment::create(['name' => 'जगदुल्ला गाउँपालिका', 'district_id' => 61]);
          LocalGovernment::create(['name' => 'मुड्केचुला गाउँपालिका', 'district_id' => 61]);
          LocalGovernment::create(['name' => 'काईके गाउँपालिका', 'district_id' => 61]);
          LocalGovernment::create(['name' => 'छार्का ताङसोङ गाउँपालिका', 'district_id' => 61]);
          
          // District 62 = Humla 
          LocalGovernment::create(['name' => 'सिमकोट गाउँपालिका', 'district_id' => 62]);
          LocalGovernment::create(['name' => 'नाम्खा गाउँपालिका', 'district_id' => 62]);
          LocalGovernment::create(['name' => 'खार्पुनाथ गाउँपालिका', 'district_id' => 62]);
          LocalGovernment::create(['name' => 'सर्केगाड गाउँपालिका', 'district_id' => 62]);
          LocalGovernment::create(['name' => 'चंखेली गाउँपालिका', 'district_id' => 62]);
          LocalGovernment::create(['name' => 'अदानचुली गाउँपालिका', 'district_id' => 62]);
          LocalGovernment::create(['name' => 'ताँजाकोट गाउँपालिका', 'district_id' => 62]);
          
          // District 63 = Jumla
          LocalGovernment::create(['name' => 'चन्दननाथ नगरपालिका ', 'district_id' => 63]);
          LocalGovernment::create(['name' => 'कनकासुन्दरी गाउँपालिका', 'district_id' => 63]);
          LocalGovernment::create(['name' => 'सिंजा गाउँपालिका', 'district_id' => 63]);
          LocalGovernment::create(['name' => 'हिमा गाउँपालिका', 'district_id' => 63]);
          LocalGovernment::create(['name' => 'तिला गाउँपालिका', 'district_id' => 63]);
          LocalGovernment::create(['name' => 'गुठिचौर गाउँपालिका', 'district_id' => 63]);
          LocalGovernment::create(['name' => 'तातोपानी गाउँपालिका', 'district_id' => 63]);
          LocalGovernment::create(['name' => 'पातारासी गाउँपालिका', 'district_id' => 63]);
          
          // District 64 = Kalikot
          LocalGovernment::create(['name' => 'खाँडाचक्र नगरपालिका ', 'district_id' => 64]);
          LocalGovernment::create(['name' => 'रास्कोट नगरपालिका ', 'district_id' => 64]);
          LocalGovernment::create(['name' => 'तिलागुफा नगरपालिका ', 'district_id' => 64]);
          LocalGovernment::create(['name' => 'पचालझरना गाउँपालिका', 'district_id' => 64]);
          LocalGovernment::create(['name' => 'सान्नी त्रिवेणी गाउँपालिका', 'district_id' => 64]);
          LocalGovernment::create(['name' => 'नरहरिनाथ गाउँपालिका', 'district_id' => 64]);
          LocalGovernment::create(['name' => 'शुभ कालिका गाउँपालिका', 'district_id' => 64]);
          LocalGovernment::create(['name' => 'महावै गाउँपालिका', 'district_id' => 64]);
          LocalGovernment::create(['name' => 'पलाता गाउँपालिका', 'district_id' => 64]);
          
          // District 65 = Mugu 
          LocalGovernment::create(['name' => 'छायाँनाथ रारा नगरपालिका ', 'district_id' => 65]);
          LocalGovernment::create(['name' => 'मुगुम कार्मारोंग गाउँपालिका', 'district_id' => 65]);
          LocalGovernment::create(['name' => 'सोरु गाउँपालिका', 'district_id' => 65]);
          LocalGovernment::create(['name' => 'खत्याड गाउँपालिका', 'district_id' => 65]);
          
          // District 66 = Surkhet 
          LocalGovernment::create(['name' => 'बीरेन्द्रनगर नगरपालिका ', 'district_id' => 66]);
          LocalGovernment::create(['name' => 'भेरीगंगा नगरपालिका ', 'district_id' => 66]);
          LocalGovernment::create(['name' => 'गुर्भाकोट नगरपालिका ', 'district_id' => 66]);
          LocalGovernment::create(['name' => 'पञ्चपुरी नगरपालिका ', 'district_id' => 66]);
          LocalGovernment::create(['name' => 'लेकवेशी नगरपालिका ', 'district_id' => 66]);
          LocalGovernment::create(['name' => 'चौकुने गाउँपालिका', 'district_id' => 66]);
          LocalGovernment::create(['name' => 'बराहताल गाउँपालिका', 'district_id' => 66]);
          LocalGovernment::create(['name' => 'चिङ्गाड गाउँपालिका', 'district_id' => 66]);
          LocalGovernment::create(['name' => 'सिम्ता गाउँपालिका', 'district_id' => 66]);
          
          // District 67 = Dailekh
          LocalGovernment::create(['name' => 'नारायण नगरपालिका ', 'district_id' => 67]);
          LocalGovernment::create(['name' => 'दुल्लु नगरपालिका ', 'district_id' => 67]);
          LocalGovernment::create(['name' => 'आठबीस नगरपालिका ', 'district_id' => 67]);
          LocalGovernment::create(['name' => 'चामुण्डा विन्द्रासैनी नगरपालिका ', 'district_id' => 67]);
          LocalGovernment::create(['name' => 'ठाँटीकाँध गाउँपालिका', 'district_id' => 67]);
          LocalGovernment::create(['name' => 'भैरवी गाउँपालिका', 'district_id' => 67]);
          LocalGovernment::create(['name' => 'महावु गाउँपालिका', 'district_id' => 67]);
          LocalGovernment::create(['name' => 'नौमुले गाउँपालिका', 'district_id' => 67]);
          LocalGovernment::create(['name' => 'डुंगेश्वर गाउँपालिका', 'district_id' => 67]);
          LocalGovernment::create(['name' => 'गुराँस गाउँपालिका', 'district_id' => 67]);
          LocalGovernment::create(['name' => 'भगवतीमाई गाउँपालिका', 'district_id' => 67]);
          
          // District 68 = Jajarkot
          LocalGovernment::create(['name' => 'भेरी नगरपालिका ', 'district_id' => 68]);
          LocalGovernment::create(['name' => 'छेडागाड नगरपालिका ', 'district_id' => 68]);
          LocalGovernment::create(['name' => 'नलगाड नगरपालिका ', 'district_id' => 68]);
          LocalGovernment::create(['name' => 'जुनीचाँदे गाउँपालिका', 'district_id' => 68]);
          LocalGovernment::create(['name' => 'कुसे गाउँपालिका', 'district_id' => 68]);
          LocalGovernment::create(['name' => 'बारेकोट गाउँपालिका', 'district_id' => 68]);
          LocalGovernment::create(['name' => 'शिवालय गाउँपालिका', 'district_id' => 68]);
          
          // Sudhurpaschim Province 
          // District 69 = kailali
          LocalGovernment::create(['name' => 'धनगढी उपमहानगरपालिका ', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'लम्कीचुहा नगरपालिका ', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'टिकापुर नगरपालिका ', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'घोडाघोडी नगरपालिका ', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'भजनी नगरपालिका ', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'गोदावरी नगरपालिका ', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'गौरीगंगा नगरपालिका ', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'जानकी गाउँपालिका', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'बर्गगोरिया गाउँपालिका', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'मोहन्याल गाउँपालिका', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'कैलारी गाउँपालिका', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'जोशीपुर गाउँपालिका', 'district_id' => 69]);
          LocalGovernment::create(['name' => 'चुरे गाउँपालिका', 'district_id' => 69]);
          
          // District 70 = Achham
          LocalGovernment::create(['name' => 'मंगलसेन नगरपालिका ', 'district_id' => 70]);
          LocalGovernment::create(['name' => 'कमलबजार नगरपालिका ', 'district_id' => 70]);
          LocalGovernment::create(['name' => 'साँफेबगर नगरपालिका ', 'district_id' => 70]);
          LocalGovernment::create(['name' => 'पन्चदेवल विनायक नगरपालिका ', 'district_id' => 70]);
          LocalGovernment::create(['name' => 'रामारोशन गाउँपालिका', 'district_id' => 70]);
          LocalGovernment::create(['name' => 'चौरपाटी गाउँपालिका', 'district_id' => 70]);
          LocalGovernment::create(['name' => 'तुर्माखाँद गाउँपालिका', 'district_id' => 70]);
          LocalGovernment::create(['name' => 'मेल्लेख गाउँपालिका', 'district_id' => 70]);
          LocalGovernment::create(['name' => 'ढँकारी गाउँपालिका', 'district_id' => 70]);
          LocalGovernment::create(['name' => 'बान्नीगडीजैगड गाउँपालिका', 'district_id' => 70]);
          
          // District 71 = Doti 
          LocalGovernment::create(['name' => 'दिपायल सिलगढी नगरपालिका ', 'district_id' => 71]);
          LocalGovernment::create(['name' => 'शिखर नगरपालिका ', 'district_id' => 71]);
          LocalGovernment::create(['name' => 'पूर्वीचौकी गाउँपालिका', 'district_id' => 71]);
          LocalGovernment::create(['name' => 'बड्डी केदार गाउँपालिका', 'district_id' => 71]);
          LocalGovernment::create(['name' => 'जोरायल गाउँपालिका', 'district_id' => 71]);
          LocalGovernment::create(['name' => 'सायल गाउँपालिका', 'district_id' => 71]);
          LocalGovernment::create(['name' => 'आदर्श गाउँपालिका', 'district_id' => 71]);
          LocalGovernment::create(['name' => 'के.आई.सिं.  गाउँपालिका', 'district_id' => 71]);
          LocalGovernment::create(['name' => 'बोगटान गाउँपालिका', 'district_id' => 71]);
          
          // District 72 = Bajhang
          LocalGovernment::create(['name' => 'जयपृथ्वी नगरपालिका ', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'बुंगल नगरपालिका ', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'तलकोट गाउँपालिका', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'मष्टा गाउँपालिका', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'छान्ना गाउँपालिका', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'थलारा गाउँपालिका', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'बित्थडचिर गाउँपालिका', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'सुर्मा गाउँपालिका', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'छब्बीसपाथिभेरा गाउँपालिका', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'दुर्गाथली गाउँपालिका', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'केदारस्यु गाउँपालिका', 'district_id' => 72]);
          LocalGovernment::create(['name' => 'सइपाल गाउँपालिका', 'district_id' => 72]);
          
          
          // District 73 = Bajura 
          LocalGovernment::create(['name' => 'बडीमालिका नगरपालिका ', 'district_id' => 73]);
          LocalGovernment::create(['name' => 'त्रिवेणी नगरपालिका ', 'district_id' => 73]);
          LocalGovernment::create(['name' => 'बुढीगंगा नगरपालिका ', 'district_id' => 73]);
          LocalGovernment::create(['name' => 'गौमुल गाउँपालिका', 'district_id' => 73]);
          LocalGovernment::create(['name' => 'जगन्‍नाथ  गाउँपालिका', 'district_id' => 73]);
          LocalGovernment::create(['name' => 'स्वामिकार्तिक खापर गाउँपालिका', 'district_id' => 73]);
          LocalGovernment::create(['name' => 'खप्तड छेडेदह गाउँपालिका', 'district_id' => 73]);
          LocalGovernment::create(['name' => 'हिमाली गाउँपालिका', 'district_id' => 73]);
          
          // District 74 = Kanchanpur
          LocalGovernment::create(['name' => 'वेदकोट नगरपालिका ', 'district_id' => 74]);
          LocalGovernment::create(['name' => 'बेलौरी नगरपालिका ', 'district_id' => 74]);
          LocalGovernment::create(['name' => 'भीमदत्त नगरपालिका ', 'district_id' => 74]);
          LocalGovernment::create(['name' => 'महाकाली नगरपालिका ', 'district_id' => 74]);
          LocalGovernment::create(['name' => 'शुक्लाफाँटा नगरपालिका ', 'district_id' => 74]);
          LocalGovernment::create(['name' => 'कृष्णपुर नगरपालिका ', 'district_id' => 74]);
          LocalGovernment::create(['name' => 'पुर्नवास नगरपालिका ', 'district_id' => 74]);
          LocalGovernment::create(['name' => 'लालझाँडी गाउँपालिका', 'district_id' => 74]);
          LocalGovernment::create(['name' => 'बेलडाँडी गाउँपालिका', 'district_id' => 74]);
          
  
        
        // District 75 = Dadeldhura
        LocalGovernment::create(['name' => 'अमरगढी नगरपालिका', 'district_id' => 75]);
        LocalGovernment::create(['name' => 'परशुराम नगरपालिका', 'district_id' => 75]);
        LocalGovernment::create(['name' => 'आलिताल गाउँपालिका', 'district_id' => 75]);
        LocalGovernment::create(['name' => 'भागेश्वर गाउँपालिका', 'district_id' => 75]);
        LocalGovernment::create(['name' => 'नवदुर्गा गाउँपालिका', 'district_id' => 75]);
        LocalGovernment::create(['name' => 'अजयमेरु गाउँपालिका', 'district_id' => 75]);
        LocalGovernment::create(['name' => 'गन्यापधुरा गाउँपालिका', 'district_id' => 75]);
        
        // District 76 = Baitadi
        LocalGovernment::create(['name' => 'दशरथचन्द नगरपालिका', 'district_id' => 76]);
        LocalGovernment::create(['name' => 'पाटन नगरपालिका', 'district_id' => 76]);
        LocalGovernment::create(['name' => 'मेलौली नगरपालिका', 'district_id' => 76]);
        LocalGovernment::create(['name' => 'पुर्चौडी नगरपालिका', 'district_id' => 76]);
        LocalGovernment::create(['name' => 'सुर्नया गाउँपालिका', 'district_id' => 76]);
        LocalGovernment::create(['name' => 'सिगास गाउँपालिका', 'district_id' => 76]);
        LocalGovernment::create(['name' => 'शिवनाथ गाउँपालिका', 'district_id' => 76]);
        LocalGovernment::create(['name' => 'पञ्चेश्वर गाउँपालिका', 'district_id' => 76]);
        LocalGovernment::create(['name' => 'दोगडाकेदार गाउँपालिका', 'district_id' => 76]);
        LocalGovernment::create(['name' => 'डिलाशैनी गाउँपालिका', 'district_id' => 76]);
        
        // District 77 = Darchula 
        LocalGovernment::create(['name' => 'महाकाली नगरपालिका', 'district_id' => 77]);
        LocalGovernment::create(['name' => 'शैल्यशिखर नगरपालिका', 'district_id' => 77]);
        LocalGovernment::create(['name' => 'मालिकार्जुन गाउँपालिका', 'district_id' => 77]);
        LocalGovernment::create(['name' => 'अपि हिमाल गाउँपालिका', 'district_id' => 77]);
        LocalGovernment::create(['name' => 'दुहु गाउँपालिका', 'district_id' => 77]);
        LocalGovernment::create(['name' => 'नौगाड गाउँपालिका', 'district_id' => 77]);
        LocalGovernment::create(['name' => 'मार्मा गाउँपालिका', 'district_id' => 77]);
        LocalGovernment::create(['name' => 'लेकम गाउँपालिका', 'district_id' => 77]);
        LocalGovernment::create(['name' => 'ब्यास गाउँपालिका', 'district_id' => 77]);   
    }
}
