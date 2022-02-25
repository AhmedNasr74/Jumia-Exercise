<?php

namespace App\Pipelines\QueryFilter;

use App\Services\CountryDataset;

final class State extends QueryFilter
{
    public function applyFilter()
    {
        return $this->{'handle' . ucfirst($this->value)}();
    }

    public function handleAll()
    {
        return $this->builder;
    }

    public function handleValid()
    {
        return $this->builder->where(function ($query) {
            foreach (CountryDataset::getCountriesData() as $idx => $country) {
                $query->{$idx == 0 ? 'whereRaw' : 'orWhereRaw'}('REGEXP(? , phone)', "'".$country['regex']."'");
            }
        });
    }
    public function handleINValid()
    {
        return $this->builder->where(function ($query) {
            foreach (CountryDataset::getCountriesData() as $idx => $country) {
                $query->whereRaw('NOT REGEXP(? , phone)', "'".$country['regex']."'");
            }
        });
    }

}
