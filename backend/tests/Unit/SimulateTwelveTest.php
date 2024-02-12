<?php

namespace Tests\Unit;

use App\Services\Car\SimulateService;
use PHPUnit\Framework\TestCase;

class SimulateTwelveTest extends TestCase
{
    public function testSimulateFees(): void
    {
        $total = (new SimulateService())->execute(12, 100);
        $this->assertTrue($total == 115.56);
    }
}
