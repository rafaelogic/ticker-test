<?php

namespace App\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ParseTickerData
{
    protected $data;

    protected $dateTimeFields = [
        'close_time',
        'open_time'
    ];

    public function execute(array $data): array
    {
        $this->data = $data;

        $this
            ->formatKeys()
            ->convertPrice()
            ->convertTs();

        return $this->data;
    }

    /**
     * Converts unix timestamp into date & time string
     */
    public function convertTs(): ParseTickerData
    {
        foreach ($this->dateTimeFields as $field) {
            $ts = $this->data[$field];
            $this->data[$field] = Carbon::createFromTimestampMs($ts)->toDateTimeString();
        }

        return $this;
    }

    public function formatKeys(): ParseTickerData
    {
        $fKeys = array_map(function ($key) {
            return Str::snake($key);
        }, array_keys($this->data));

        $this->data = array_combine($fKeys, $this->data);
        return $this;
    }

    public function convertPrice(): ParseTickerData
    {
        $data = $this->data;

        foreach ($data as $key => $val) {
            if (is_numeric($val)) {
                if (strpos($val, '.') !== false) {
                    $data[$key] = (float)$val;
                } else {
                    $data[$key] = (int)$val;
                }
            }
        }

        $this->data = $data;
        return $this;
    }
}