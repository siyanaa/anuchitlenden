<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // =========================
        // KOSHI PROVINCE DISTRICTS
        // =========================

        //Bhojpur 1
        User::create([
            'name' => 'bhojpur_admin',
            'email' => 'bhojpur@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 1,
            'state_id' => 1
        ]);

        //Dhankuta 2
        User::create([
            'name' => 'dhankuta_admin',
            'email' => 'dhankuta@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 2,
            'state_id' => 1
        ]);

        // Ilam 3
        User::create([
            'name' => 'ilam_admin',
            'email' => 'ilam@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 3,
            'state_id' => 1
        ]);

        //Jhapa 4
        User::create([
            'name' => 'jhapa_admin',
            'email' => 'jhapa@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 4,
            'state_id' => 1
        ]);

        //Khotang 5
        User::create([
            'name' => 'khotang_admin',
            'email' => 'khotang@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 5,
            'state_id' => 1
        ]);

        //Morang 6
        User::create([
            'name' => 'morang_admin',
            'email' => 'morang@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 6,
            'state_id' => 1
        ]);

        // Okhaldunga 7
        User::create([
            'name' => 'okhaldunga_admin',
            'email' => 'okhaldunga@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 7,
            'state_id' => 1
        ]);

        // Panchthar 8
        User::create([
            'name' => 'pachthar_admin',
            'email' => 'pachthar@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 8,
            'state_id' => 1
        ]);

        // Sankhuwasabha 9
        User::create([
            'name' => 'sankhuwasabha_admin',
            'email' => 'sankhuwasabha@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 9,
            'state_id' => 1
        ]);

        // Solukhumbu 10
        User::create([
            'name' => 'solukhumbu_admin',
            'email' => 'solukhumbu@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 10,
            'state_id' => 1
        ]);

        // Sunsari 11
        User::create([
            'name' => 'sunsari_admin',
            'email' => 'sunsari@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 11,
            'state_id' => 1
        ]);

        // Taplejung 12
        User::create([
            'name' => 'taplejung_admin',
            'email' => 'taplejung@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 12,
            'state_id' => 1
        ]);

        // Terathum 13
        User::create([
            'name' => 'terathum_admin',
            'email' => 'terathum@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 13,
            'state_id' => 1
        ]);

        // Udayapur 14
        User::create([
            'name' => 'udayapur_admin',
            'email' => 'udayapur@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 14,
            'state_id' => 1
        ]);

        // =========================
        // MADHESH PROVINCE DISTRICTS
        // =========================

        // Parsa 15
        User::create([
            'name' => 'parsa_admin',
            'email' => 'parsa@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 15,
            'state_id' => 2
        ]);

        // Bara 16
        User::create([
            'name' => 'bara_admin',
            'email' => 'bara@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 16,
            'state_id' => 2
        ]);

        // Rautahat 17
        User::create([
            'name' => 'rautahat_admin',
            'email' => 'rautahat@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 17,
            'state_id' => 2
        ]);

        // Sarlahi 18
        User::create([
            'name' => 'sarlahi_admin',
            'email' => 'sarlahi@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 18,
            'state_id' => 2
        ]);

        // Dhanusha 19
        User::create([
            'name' => 'dhanusha_admin',
            'email' => 'dhanusha@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 19,
            'state_id' => 2
        ]);

        // Siraha 20
        User::create([
            'name' => 'siraha_admin',
            'email' => 'siraha@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 20,
            'state_id' => 2
        ]);

        // Mahottari 21
        User::create([
            'name' => 'mahottari_admin',
            'email' => 'mahottari@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 21,
            'state_id' => 2
        ]);

        // Saptari 22
        User::create([
            'name' => 'saptari_admin',
            'email' => 'saptari@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 22,
            'state_id' => 2
        ]);


        // =========================
        // BAGMATI PROVINCE DISTRICTS
        // =========================

        // Sindhuli 23
        User::create([
            'name' => 'sindhuli_admin',
            'email' => 'sindhuli@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 23,
            'state_id' => 3
        ]);

        // Ramechhap 24
        User::create([
            'name' => 'ramechhap_admin',
            'email' => 'ramechhap@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 24,
            'state_id' => 3
        ]);

        // Dolakha 25
        User::create([
            'name' => 'dolakha_admin',
            'email' => 'dolakha@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 25,
            'state_id' => 3
        ]);

        // Bhaktapur 26
        User::create([
            'name' => 'bhaktapur_admin',
            'email' => 'bhaktapur@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 26,
            'state_id' => 3
        ]);

        // Dhading 27
        User::create([
            'name' => 'dhading_admin',
            'email' => 'dhading@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 27,
            'state_id' => 3
        ]);

        // Kathmandu 28
        User::create([
            'name' => 'kathmandu_admin',
            'email' => 'kathmandu@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 28,
            'state_id' => 3
        ]);

        // Kavrepalanchowk 29
        User::create([
            'name' => 'kavrepalanchowk_admin',
            'email' => 'kavrepalanchowk@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 29,
            'state_id' => 3
        ]);

        // Lalitpur 30
        User::create([
            'name' => 'lalitpur_admin',
            'email' => 'lalitpur@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 30,
            'state_id' => 3
        ]);

        // Nuwakot 31
        User::create([
            'name' => 'nuwakot_admin',
            'email' => 'nuwakot@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 31,
            'state_id' => 3
        ]);

        // Rasuwa 32
        User::create([
            'name' => 'rasuwa_admin',
            'email' => 'rasuwa@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 32,
            'state_id' => 3
        ]);

        // Sindhupalchowk 33
        User::create([
            'name' => 'sindhupalchowk_admin',
            'email' => 'sindhupalchowk@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 33,
            'state_id' => 3
        ]);

        // Chitwan 34
        User::create([
            'name' => 'chitwan_admin',
            'email' => 'chitwan@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 34,
            'state_id' => 3
        ]);

        // Makwanpur 35
        User::create([
            'name' => 'makwanpur_admin',
            'email' => 'makwanpur@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 35,
            'state_id' => 3
        ]);

        // =========================
        // GANDAKI PROVINCE DISTRICTS
        // =========================

        // Baglung 36
        User::create([
            'name' => 'baglung_admin',
            'email' => 'baglung@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 36,
            'state_id' => 4
        ]);

        // Gorkha 37
        User::create([
            'name' => 'gorkha_admin',
            'email' => 'gorkha@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 37,
            'state_id' => 4
        ]);

        // Kaski 38
        User::create([
            'name' => 'kaski_admin',
            'email' => 'kaski@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 38,
            'state_id' => 4
        ]);

        // Lamjung 39
        User::create([
            'name' => 'lamjung_admin',
            'email' => 'lamjung@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 39,
            'state_id' => 4
        ]);

        // Manang 40
        User::create([
            'name' => 'manang_admin',
            'email' => 'manang@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 40,
            'state_id' => 4
        ]);

        // Mustang 41
        User::create([
            'name' => 'mustang_admin',
            'email' => 'mustang@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 41,
            'state_id' => 4
        ]);

        // Myagdi 42
        User::create([
            'name' => 'myagdi_admin',
            'email' => 'myagdi@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 42,
            'state_id' => 4
        ]);

        // Nawalpur 43
        User::create([
            'name' => 'nawalpur_admin',
            'email' => 'nawalpur@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 43,
            'state_id' => 4
        ]);

        // Parbat 44
        User::create([
            'name' => 'parbat_admin',
            'email' => 'parbat@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 44,
            'state_id' => 4
        ]);

        // Syangja 45
        User::create([
            'name' => 'syanja_admin',
            'email' => 'syanja@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 46,
            'state_id' => 4
        ]);

        // Tanahun 46
        User::create([
            'name' => 'tanahun_admin',
            'email' => 'tanahun@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 46,
            'state_id' => 4
        ]);

        // =========================
        // LUMBINI PROVINCE DISTRICTS
        // =========================

        // Kapilvastu 47
        User::create([
            'name' => 'kapilvastu_admin',
            'email' => 'kapilvastu@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 47,
            'state_id' => 5
        ]);

        // Parasi 48
        User::create([
            'name' => 'parasi_admin',
            'email' => 'parasi@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 48,
            'state_id' => 5
        ]);

        // Rupandehi 49
        User::create([
            'name' => 'rupandehi_admin',
            'email' => 'rupandehi@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 49,
            'state_id' => 5
        ]);

        // Argakhanchi 50
        User::create([
            'name' => 'argakhanchi_admin',
            'email' => 'argakhanchi@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 50,
            'state_id' => 5
        ]);

        // Gulmi 51
        User::create([
            'name' => 'gulmi_admin',
            'email' => 'gulmi@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 51,
            'state_id' => 5
        ]);

        // Palpa 52
        User::create([
            'name' => 'palpa_admin',
            'email' => 'palpa@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 52,
            'state_id' => 5
        ]);

        // Dang 53
        User::create([
            'name' => 'dang_admin',
            'email' => 'dang@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 53,
            'state_id' => 5
        ]);

        // Pyuthan 54
        User::create([
            'name' => 'pyuthan_admin',
            'email' => 'pyuthan@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 54,
            'state_id' => 5
        ]);

        // Rolpa 55
        User::create([
            'name' => 'rolpa_admin',
            'email' => 'rolpa@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 55,
            'state_id' => 5
        ]);

        // Eastern Rukum 56
        User::create([
            'name' => 'easternrukum_admin',
            'email' => 'easternrukum@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 56,
            'state_id' => 5
        ]);

        // Banke 57
        User::create([
            'name' => 'banke_admin',
            'email' => 'banke@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 57,
            'state_id' => 5
        ]);

        // Bardiya 58
        User::create([
            'name' => 'bardiya_admin',
            'email' => 'bardiya@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 58,
            'state_id' => 5
        ]);


        // =========================
        // KARNALI PROVINCE DISTRICTS
        // =========================

        // Western Rukum 59
        User::create([
            'name' => 'westernrukum_admin',
            'email' => 'westernrukum@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 59,
            'state_id' => 6
        ]);

        // Salyan 60
        User::create([
            'name' => 'salyan_admin',
            'email' => 'salyan@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 60,
            'state_id' => 6
        ]);

        // Dolpa 61
        User::create([
            'name' => 'dolpa_admin',
            'email' => 'dolpa@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 61,
            'state_id' => 6
        ]);

        // Humla 62
        User::create([
            'name' => 'humla_admin',
            'email' => 'humla@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 62,
            'state_id' => 6
        ]);

        // Jumla 63
        User::create([
            'name' => 'jumla_admin',
            'email' => 'jumla@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 63,
            'state_id' => 6
        ]);

        // Kalikot 64
        User::create([
            'name' => 'kalikot_admin',
            'email' => 'kalikot@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 64,
            'state_id' => 6
        ]);

        // Mugu 65
        User::create([
            'name' => 'mugu_admin',
            'email' => 'mugu@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 65,
            'state_id' => 6
        ]);

        // Surkhet 66
        User::create([
            'name' => 'surkhet_admin',
            'email' => 'surkhet@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 66,
            'state_id' => 6
        ]);

        // Dailekh 67
        User::create([
            'name' => 'dailekh_admin',
            'email' => 'dailekh@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 67,
            'state_id' => 6
        ]);

        // Jajarkot 68
        User::create([
            'name' => 'jajarkot_admin',
            'email' => 'jajarkot@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 68,
            'state_id' => 6
        ]);


        // =========================
        // GANDAKI PROVINCE DISTRICTS
        // =========================

        // Kailali 69
        User::create([
            'name' => 'kailali_admin',
            'email' => 'kailali@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 69,
            'state_id' => 7
        ]);

        // Achham 70
        User::create([
            'name' => 'achham_admin',
            'email' => 'achham@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 71,
            'state_id' => 7
        ]);

        // Doti 71
        User::create([
            'name' => 'doti_admin',
            'email' => 'doti@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 71,
            'state_id' => 7
        ]);

        // Bajhang 72
        User::create([
            'name' => 'bajhang_admin',
            'email' => 'bajhang@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 72,
            'state_id' => 7
        ]);

        // Bajura 73
        User::create([
            'name' => 'bajura_admin',
            'email' => 'bajura@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 74,
            'state_id' => 7
        ]);

        // Kanchanpur 74
        User::create([
            'name' => 'kanchanpur_admin',
            'email' => 'kanchanpur@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 74,
            'state_id' => 7
        ]);

        // Dadeldhura 75
        User::create([
            'name' => 'dadeldhura_admin',
            'email' => 'dadeldhura@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 75,
            'state_id' => 7
        ]);

        // Baitadi 76
        User::create([
            'name' => 'baitadi_admin',
            'email' => 'baitadi@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 76,
            'state_id' => 7
        ]);

        // Darchula 77
        User::create([
            'name' => 'darchula_admin',
            'email' => 'darchula@admin.com',
            'password' => Hash::make('nepal@2080'),
            'is_active' => 1,
            'role' => 3,
            'district_id' => 77,
            'state_id' => 7
        ]);

       
        User::create([
            'name' => 'मन्त्रालय',
            'email' => 'super_admin@superadmin.com',
            'password' => Hash::make('super_nepal@2080'),
            'is_active' => 1,
            'role' => 1,
        ]);
        
        User::create([
            'name' => 'आयोग',
            'email' => 'superadmin@superadmin.com',
            'password' => Hash::make('supernepal@2080'),
            'is_active' => 1,
            'role' => 2,
        ]);
        
    }
}
