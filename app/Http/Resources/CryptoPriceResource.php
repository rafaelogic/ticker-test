<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CryptoPriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'lowest_market_price'   => $this->lowest_market_price,
            'lowest_close_time'     => formatDateTime($this->lowest_close_time),
            'highest_market_price'  => $this->highest_market_price,
            'highest_close_time'    => formatDateTime($this->highest_close_time)
        ];
    }

    
}
