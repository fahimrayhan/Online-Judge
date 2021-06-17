<?php

namespace App\Services\Country;

use App\Models\Country;

class CountryService
{
    public function createCountry($data)
    {
        Country::create($data);
    }

    public function getAllCountry()
    {
        return Country::all();
    }

    public function getCountry($Id)
    {
        return Country::findOrFail($Id);
    }

    public function updateCountry(Country $country,$data)
    {
        
        $country->update($data);
    }

}
