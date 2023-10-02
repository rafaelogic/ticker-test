<?php

namespace App\Jobs;

use App\Events\NewTickerData;
use App\Models\CryptoPrice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class RunTicker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url = 'https://api.binance.com/api/v3/ticker/24hr?symbol=BTCUSDT';

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            
            NewTickerData::dispatch($data);
        } else {
            $response->throw();
        }
    }
}
