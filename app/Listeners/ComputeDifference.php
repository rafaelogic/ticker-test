<?php

namespace App\Listeners;

use App\Events\NewTickerData;

class ComputeDifference
{
    use QueueTrait;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewTickerData $event): void
    {
        $data = $event->data;
        
        $lowPrice = $data['low_price'];
        $highPrice = $data['high_price'];
        $lastPrice = $data['last_price'];

        $data['diff_high_low'] = $highPrice - $lowPrice;
        $data['diff_high_last_market_price'] = $highPrice - $lastPrice;
        $data['diff_low_last_market_price'] = $lowPrice - $lastPrice;

        $event->data = $data;
    }
}
