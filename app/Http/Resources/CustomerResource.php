<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'country' => $this->country,
            'phone' => $this->phone_num,
            'state' => $this->state == true ? 'OK' : 'NOK',
            'country_code' => $this->country_code,
        ];
    }
}
