<?php

namespace App\Actions;

use App\Models\CryptoPrice;
use Illuminate\Support\Facades\DB;

class RetrievePrice
{
    public function execute(array $data): CryptoPrice
    {
        $startDate = $data['date_from'];
        $endDate = $data['date_to'];
        
        $result = CryptoPrice::select([
                DB::raw("
                    (SELECT low_price 
                        FROM crypto_prices
                        ORDER BY low_price 
                        ASC LIMIT 1
                    ) as lowest_market_price"
                ),
                DB::raw("
                    (SELECT close_time 
                        FROM crypto_prices 
                        WHERE low_price = lowest_market_price 
                        LIMIT 1) as lowest_close_time"
                    ),
                DB::raw("
                    (SELECT high_price 
                        FROM crypto_prices 
                        ORDER BY high_price 
                        DESC LIMIT 1) as highest_market_price"
                    ),
                DB::raw("
                    (SELECT close_time 
                        FROM crypto_prices 
                        WHERE high_price = highest_market_price 
                        LIMIT 1) as highest_close_time"
                    )
            ])
            ->whereBetween('close_time', [$startDate, $endDate])
            ->first();
        
        return $result;
    }
}