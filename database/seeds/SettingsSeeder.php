<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
        $setting->name = 'Teknik Servis';
        $setting->web_site = 'http://www.cozumlazim.com';
        $setting->email = 'sefa.kendirli@gmail.com';
        $setting->save();
    }
}
