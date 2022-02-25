<?php

namespace App\Models;

use App\Traits\DetectCountry;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use DetectCountry;

    protected $table = 'customer';

    public function getPhoneNumAttribute()
    {
        return explode(' ', $this->phone)[1];
    }
}
