<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Model;
use App\Models\Countries\CountriesCountriesM;

class CountriesGovernmentM extends Model
{
       protected $table = "countries_governments";
    public $timestamps = true;

    protected $fillable = [
        'label_en',
        'label_ar',
        'value_en',
        'value_ar',
        'country_id'
    ];
        public function country()
    {
        return $this->belongsTo(CountriesCountriesM::class);
    }
}
