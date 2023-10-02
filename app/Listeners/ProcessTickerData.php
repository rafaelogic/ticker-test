<?php

namespace App\Listeners;

use App\Actions\ParseTickerData;
use App\Events\NewTickerData;

class ProcessTickerData
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
        $data = app(ParseTickerData::class)->execute($event->data);
        $event->data = $data;
    }
}
