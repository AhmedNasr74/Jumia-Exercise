<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Pipelines\QueryFilter\Country;
use App\Pipelines\QueryFilter\State;
use Illuminate\Routing\Pipeline;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = app(Pipeline::class)
            ->send(Customer::select('phone'))
            ->through([
                State::class,
                Country::class,
            ])->thenReturn()
            ->paginate(request('per_page', 5));
        $customers->setCollection(collect(CustomerResource::collection($customers->getCollection())));
        return response()->json(['customers' => $customers]);
    }
}
