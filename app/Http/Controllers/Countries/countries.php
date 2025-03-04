<?php

namespace App\Http\Controllers\Countries;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Countries\CountriesCountriesM;
use App\Models\Countries\CountriesGovernmentM;

class countries extends Controller
{
    public function getAllCountries()
    {
     $governments = CountriesCountriesM::all();
     return response()->json($governments);
    }
    public function getGovernments($country_id)
    {
     $governments = CountriesGovernmentM::where('country_id', $country_id)->get();
     return response()->json($governments);
    }
}
