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
        $egypt = CountriesCountriesM::where('label_ar', 'مصر')->first();
        $egypt_governments = [
            [
                'label_en' => 'Cairo', 'label_ar' => 'القاهرة',
                'value_en' => 'Cairo', 'value_ar' => 'القاهرة'
            ],
            [
                'label_en' => 'Alexandria', 'label_ar' => 'الإسكندرية',
                'value_en' => 'Alexandria', 'value_ar' => 'الإسكندرية'
            ],
            [
                'label_en' => 'Giza', 'label_ar' => 'الجيزة',
                'value_en' => 'Giza', 'value_ar' => 'الجيزة'
            ],
            [
                'label_en' => 'Asyut', 'label_ar' => 'أسيوط',
                'value_en' => 'Asyut', 'value_ar' => 'أسيوط'
            ],
            [
                'label_en' => 'Minya', 'label_ar' => 'المنيا',
                'value_en' => 'Minya', 'value_ar' => 'المنيا'
            ],
            [
                'label_en' => 'Sohag', 'label_ar' => 'سوهاج',
                'value_en' => 'Sohag', 'value_ar' => 'سوهاج'
            ],
            [
                'label_en' => 'Dakahlia', 'label_ar' => 'الدقهلية',
                'value_en' => 'Dakahlia', 'value_ar' => 'الدقهلية'
            ],
            [
                'label_en' => 'Sharqia', 'label_ar' => 'الشرقية',
                'value_en' => 'Sharqia', 'value_ar' => 'الشرقية'
            ],
            [
                'label_en' => 'Other', 'label_ar' => 'أخرى',
                'value_en' => 'Other', 'value_ar' => 'أخرى'
            ],
        ];

        foreach ($egypt_governments as $government) {
            CountriesGovernmentM::create([
                'label_en' => $government['label_en'],
                'label_ar' => $government['label_ar'],
                'value_en' => $government['value_en'],
                'value_ar' => $government['value_ar'],
                'country_id' => $egypt->id
            ]);
        }

        $saudi_arabia = CountriesCountriesM::where('label_ar', "المملكة العربية السعودية")->first();
        $saudi_governments = [
            [
                'label_en' => 'Riyadh', 'label_ar' => 'الرياض',
                'value_en' => 'Riyadh', 'value_ar' => 'الرياض'
            ],
            [
                'label_en' => 'Mecca', 'label_ar' => 'مكة',
                'value_en' => 'Mecca', 'value_ar' => 'مكة'
            ],
            [
                'label_en' => 'Medina', 'label_ar' => 'المدينة المنورة',
                'value_en' => 'Medina', 'value_ar' => 'المدينة المنورة'
            ],
            [
                'label_en' => 'Jeddah', 'label_ar' => 'جدة',
                'value_en' => 'Jeddah', 'value_ar' => 'جدة'
            ],
            [
                'label_en' => 'Dammam', 'label_ar' => 'الدمام',
                'value_en' => 'Dammam', 'value_ar' => 'الدمام'
            ],
            [
                'label_en' => 'Khobar', 'label_ar' => 'الخبر',
                'value_en' => 'Khobar', 'value_ar' => 'الخبر'
            ],
            [
                'label_en' => 'Other', 'label_ar' => 'أخرى',
                'value_en' => 'Other', 'value_ar' => 'أخرى'
            ],
        ];

        foreach ($saudi_governments as $government) {
            CountriesGovernmentM::create([
                'label_en' => $government['label_en'],
                'label_ar' => $government['label_ar'],
                'value_en' => $government['value_en'],
                'value_ar' => $government['value_ar'],
                'country_id' => $saudi_arabia->id
            ]);
        }

        $uae = CountriesCountriesM::where('label_ar', "الإمارات العربية المتحدة")->first();
        $uae_governments = [
            [
                'label_en' => 'Abu Dhabi', 'label_ar' => 'أبوظبي',
                'value_en' => 'Abu Dhabi', 'value_ar' => 'أبوظبي'
            ],
            [
                'label_en' => 'Dubai', 'label_ar' => 'دبي',
                'value_en' => 'Dubai', 'value_ar' => 'دبي'
            ],
            [
                'label_en' => 'Sharjah', 'label_ar' => 'الشارقة',
                'value_en' => 'Sharjah', 'value_ar' => 'الشارقة'
            ],
            [
                'label_en' => 'Al Ain', 'label_ar' => 'العين',
                'value_en' => 'Al Ain', 'value_ar' => 'العين'
            ],
            [
                'label_en' => 'Fujairah', 'label_ar' => 'الفجيرة',
                'value_en' => 'Fujairah', 'value_ar' => 'الفجيرة'
            ],
            [
                'label_en' => 'Ajman', 'label_ar' => 'عجمان',
                'value_en' => 'Ajman', 'value_ar' => 'عجمان'
            ],
            [
                'label_en' => 'Other', 'label_ar' => 'أخرى',
                'value_en' => 'Other', 'value_ar' => 'أخرى'
            ],
        ];

        foreach ($uae_governments as $government) {
            CountriesGovernmentM::create([
                'label_en' => $government['label_en'],
                'label_ar' => $government['label_ar'],
                'value_en' => $government['value_en'],
                'value_ar' => $government['value_ar'],
                'country_id' => $uae->id
            ]);
        }
    }
}
