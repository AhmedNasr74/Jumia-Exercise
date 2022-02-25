<?php

namespace App\Pipelines\QueryFilter;

use App\Services\CountryDataset;

final class Country extends QueryFilter
{
    public function applyFilter()
    {
        return $this->builder->where('phone', 'LIKE', '(' . CountryDataset::getCountryCode($this->value) . ')%');
    }
}
