<?php

namespace App\Services;

class CountryDataset
{
    private static $countries = [
        ['name' => 'Cameroon', 'country_code' => '237', 'regex' => '\(237\)\ ?[2368]\d{7,8}$'],
        ['name' => 'Ethiopia', 'country_code' => '251', 'regex' => '\(251\)\ ?[1-59]\d{8}$'],
        ['name' => 'Morocco', 'country_code' => '212', 'regex' => '\(212\)\ ?[5-9]\d{8}$'],
        ['name' => 'Mozambique', 'country_code' => '258', 'regex' => '\(258\)\ ?[28]\d{7,8}$'],
        ['name' => 'Uganda', 'country_code' => '256', 'regex' => '\(256\)\ ?\d{9}$'],
    ];

    public static function getCountriesData(): \Illuminate\Support\Collection
    {
        return collect(self::$countries);
    }

    public static function getCountryCode($country){
        return self::getCountriesData()->where('name' , $country)
            ->first()['country_code']??'';
    }
}
