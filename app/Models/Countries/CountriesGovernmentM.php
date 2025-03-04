<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Model;
use App\Models\Countries\CountriesCountriesM;

class CountriesGovernmentM extends Model
{
       protected $table = "countries_governments";
    public $timestamps = true;

    protected $fillable = [
        'name_en',
        'name_ar',
        'country_id'
    ];
        public function country()
    {
        return $this->belongsTo(CountriesCountriesM::class);
    }
}
