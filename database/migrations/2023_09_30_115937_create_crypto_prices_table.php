<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $decColumns = [
            'price_change',
            'price_change_percent',
            'weighted_avg_price',
            'prev_close_price',
            'last_price',
            'last_qty',
            'bid_price',
            'bid_qty',
            'ask_price',
            'ask_qty',
            'open_price',
            'high_price',
            'low_price',
            'volume',
            'quote_volume',
            'diff_high_low',
            'diff_high_last_market_price',
            'diff_low_last_market_price'
        ];

        $intColumns = [
            'first_id',
            'last_id',
            'count'
        ];

        Schema::create('crypto_prices', function (Blueprint $table) use ($decColumns, $intColumns) {
            $table->id();
            $table->string('symbol');

            for ($i=0; $i<count($decColumns); $i++) {
                $table->decimal(
                    column:$decColumns[$i], 
                    total:20,
                    places:8
                );
            }

            for ($i=0; $i<count($intColumns); $i++) {
                $table->unsignedBigInteger($intColumns[$i]);
            }
            
            $table->dateTime('close_time');
            $table->dateTime('open_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_prices');
    }
};
