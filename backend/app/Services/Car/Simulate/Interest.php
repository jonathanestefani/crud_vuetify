<?php

namespace App\Services\Car\Simulate;

class Interest
{
    public static function execute(float $percentual, float $value)
    {
        return $value * ($percentual / 100);
    }
}
