<?php

use Illuminate\Support\Carbon;

if (! function_exists('formatDateTime')) {
    function formatDateTime($dateTime): string
    {
        return Carbon::parse($dateTime)->format('jS M Y H:i');
    }
}