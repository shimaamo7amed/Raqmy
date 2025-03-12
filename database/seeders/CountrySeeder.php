<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            [
                "label_en" => "Egypt",
                "label_ar" => "مصر",
                "value_en" => "Egypt",
                "value_ar" => "مصر",
            ],
            [
                "label_en" => "Saudi Arabia",
                "label_ar" => "المملكة العربية السعودية",
                "value_en" => "Saudi Arabia",
                "value_ar" => "السعودية",
            ],
            [
                "label_en" => "United Arab Emirates",
                "label_ar" => "الإمارات العربية المتحدة",
                "value_en" => "UAE",
                "value_ar" => "الإمارات العربية المتحدة",
            ]
        ];
        DB::table('countries_countries')->insert($countries);
      

           foreach ($countries as $country) {
            echo "{ label_en: \"{$country['label_en']}\", value_en: \"{$country['value_en']}\" }<br>";
            echo "{ label_ar: \"{$country['label_ar']}\", value_ar: \"{$country['value_ar']}\" }<br><br>";
        }
    }
}

