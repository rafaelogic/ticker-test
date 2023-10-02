<?php

namespace App\Listeners;

use App\Events\NewTickerData;
use App\Models\CryptoPrice;

class StoreTickerData 
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
        CryptoPrice::create($event->data);
    }
}
