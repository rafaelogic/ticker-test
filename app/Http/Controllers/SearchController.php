<?php

namespace App\Http\Controllers;

use App\Actions\RetrievePrice;
use App\Http\Requests\SearchFormRequest;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SearchFormRequest $request)
    {
        $data = $request->validated();
        $price = app(RetrievePrice::class)->execute($data);

        $from = formatDateTime($data['date_from']);
        $to = formatDateTime($data['date_to']);
        
        $header = "Result: From '$from' to '$to'";

        return redirect()->back()->with(compact('price', 'header'));
    }
}
