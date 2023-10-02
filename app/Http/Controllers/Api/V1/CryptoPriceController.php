<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\RetrievePrice;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchFormRequest;
use App\Http\Resources\CryptoPriceResource;

class CryptoPriceController extends Controller
{
    public function index(SearchFormRequest $request)
    {
        $data = $request->validated();
        $result = app(RetrievePrice::class)->execute($data);

        return new CryptoPriceResource($result);
    }   
}
