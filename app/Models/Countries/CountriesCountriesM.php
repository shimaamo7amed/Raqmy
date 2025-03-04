<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Model;
use App\Models\Countries\CountriesGovernmentM;

class CountriesCountriesM extends Model
{
    protected $table = "countries_countries";
    public $timestamps = true;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

        public function governments()
    {
        return $this->hasMany(CountriesGovernmentM::class);
    }
}
