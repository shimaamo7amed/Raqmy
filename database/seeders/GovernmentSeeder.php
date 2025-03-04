<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Countries\CountriesCountriesM;
use App\Models\Countries\CountriesGovernmentM;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernmentSeeder extends Seeder
{
    public function run()
    {

        $egypt = CountriesCountriesM::where('name_ar', 'مصر')->first();
        $egypt_governments = [
            ['name_ar' => 'القاهرة', 'name_en' => 'Cairo'],
            ['name_ar' => 'الإسكندرية', 'name_en' => 'Alexandria'],
            ['name_ar' => 'الجيزة', 'name_en' => 'Giza'],
            ['name_ar' => 'أسيوط', 'name_en' => 'Asyut'],
            ['name_ar' => 'المنيا', 'name_en' => 'Minya'],
            ['name_ar' => 'سوهاج', 'name_en' => 'Sohag'],
            ['name_ar' => 'الدقهلية', 'name_en' => 'Dakahlia'],
            ['name_ar' => 'الشرقية', 'name_en' => 'Sharqia'],
            ['name_ar' =>'أخري', 'name_en' => 'Other'],
          
        ];

        foreach ($egypt_governments as $government) {
           CountriesGovernmentM::create([
                'name_ar' => $government['name_ar'],
                'name_en' => $government['name_en'],
                'country_id' => $egypt->id
            ]);
        }
        $saudi_arabia = CountriesCountriesM::where('name_ar', 'السعودية')->first();
        $saudi_governments = [
            ['name_ar' => 'الرياض', 'name_en' => 'Riyadh'],
            ['name_ar' => 'مكة', 'name_en' => 'Mecca'],
            ['name_ar' => 'المدينة المنورة', 'name_en' => 'Medina'],
            ['name_ar' => 'جدة', 'name_en' => 'Jeddah'],
            ['name_ar' => 'الدمام', 'name_en' => 'Dammam'],
            ['name_ar' => 'الخبر', 'name_en' => 'Khobar'],
            ['name_ar' =>'أخري', 'name_en' => 'Other'],

        ];

        foreach ($saudi_governments as $government) {
         CountriesGovernmentM::create([
                'name_ar' => $government['name_ar'],
                'name_en' => $government['name_en'],
                'country_id' => $saudi_arabia->id
            ]);
        }
        $uae = CountriesCountriesM::where('name_ar', 'الإمارات')->first();
        $uae_governments = [
            ['name_ar' => 'أبوظبي', 'name_en' => 'Abu Dhabi'],
            ['name_ar' => 'دبي', 'name_en' => 'Dubai'],
            ['name_ar' => 'الشارقة', 'name_en' => 'Sharjah'],
            ['name_ar' => 'العين', 'name_en' => 'Al Ain'],
            ['name_ar' => 'الفجيرة', 'name_en' => 'Fujairah'],
            ['name_ar' => 'عجمان', 'name_en' => 'Ajman'],
            ['name_ar' =>'أخري', 'name_en' => 'Other'],

        ];

        foreach ($uae_governments as $government) {
         CountriesGovernmentM::create([
                'name_ar' => $government['name_ar'],
                'name_en' => $government['name_en'],
                'country_id' => $uae->id
            ]);
        }
    }

}
