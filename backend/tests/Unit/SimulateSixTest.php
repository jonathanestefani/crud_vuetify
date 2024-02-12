<?php

namespace Tests\Unit;

use App\Services\Car\SimulateService;
use PHPUnit\Framework\TestCase;

class SimulateSixTest extends TestCase
{
    public function testSimulateFees(): void
    {
        $total = (new SimulateService())->execute(6, 100);
        $this->assertTrue($total == 112.47);
    }
}
