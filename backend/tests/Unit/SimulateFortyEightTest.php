<?php

namespace Tests\Unit;

use App\Services\Car\SimulateService;
use PHPUnit\Framework\TestCase;

class SimulateFortyEightTest extends TestCase
{
    public function testSimulateFees(): void
    {
        $total = (new SimulateService())->execute(48, 100);
        $this->assertTrue($total == 118.69);
    }
}
