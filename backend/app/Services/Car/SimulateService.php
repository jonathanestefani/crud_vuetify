<?php

namespace App\Services\Car;

use App\BaseRepository\THttpRequest;
use App\Services\Car\Simulate\Interest;

class SimulateService
{
    use THttpRequest;

    private const interest_on_installment_six = 12.47;
    private const interest_on_installment_twelve = 15.56;
    private const interest_on_installment_forty_eight = 18.69;

    public function execute(float $portion, float $total)
    {
        if ($portion <= 6) {
            return $total + Interest::execute(self::interest_on_installment_six, $total);
        } else if ($portion <= 12) {
            return $total + Interest::execute(self::interest_on_installment_twelve, $total);
        } else {
            return $total + Interest::execute(self::interest_on_installment_forty_eight, $total);
        }
    }
}
