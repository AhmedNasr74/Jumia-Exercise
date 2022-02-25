<?php

namespace App\Traits;

use App\Services\CountryDataset;

trait DetectCountry
{
    public function getCountryAttribute(): string
    {
        foreach (CountryDataset::getCountriesData() as $country):
            if (preg_match("/^" . $country['country_code'] . "/", str_replace(['(', ')'], '', $this->phone)))
                return $country['name'];
        endforeach;
        return 'Not Found';
    }

    public function getCountryCodeAttribute(): string
    {
        return '+' . CountryDataset::getCountriesData()
                ->where('name', $this->country)
                ->first()['country_code'] ?? '';
    }

    public function getStateAttribute(): string
    {
        $country = CountryDataset::getCountriesData()
            ->where('name', $this->country)
            ->first();
        return $country ? preg_match('/'.$country['regex'].'/', $this->phone) : false;
    }
}
