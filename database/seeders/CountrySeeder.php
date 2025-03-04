<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Countries\CountriesCountriesM;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countries = [
            ['name_ar' => 'مصر', 'name_en' => 'Egypt'],
            ['name_ar' => 'السعودية', 'name_en' => 'Saudi Arabia'],
            ['name_ar' => 'الإمارات', 'name_en' => 'UAE']
        ];

        foreach ($countries as $country) {
            CountriesCountriesM::create([
                'name_ar' => $country['name_ar'],
                'name_en' => $country['name_en'],
            ]);
        }
    }
}
