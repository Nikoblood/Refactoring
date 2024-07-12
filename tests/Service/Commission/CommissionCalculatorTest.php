<?php

namespace App\Tests\Service\Commission;

use App\Model\DTO\InputRow;
use App\Service\Bin\BinProviderInterface;
use App\Service\Commission\CommissionCalculator;
use App\Service\Rate\RateProviderInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CommissionCalculatorTest extends TestCase
{
    private CommissionCalculator $commissionCalculator;

    private MockObject $binProvider;

    private MockObject $rateProvider;

    protected function setUp(): void
    {
        $this->rateProvider = $this->createMock(RateProviderInterface::class);
        $this->binProvider = $this->createMock(BinProviderInterface::class);

        $this->commissionCalculator = new CommissionCalculator(
            $this->binProvider,
            $this->rateProvider,
        );
    }

    public function testCalculate(): void
    {
        $expectedResult = 0.5;

        $input = [
            new InputRow(100.00, 'EUR', '45717360'),
        ];

        $this->binProvider
            ->expects(self::once())
            ->method('getCountryCode')
            ->with('45717360')
            ->willReturn('PO');

        $this->rateProvider
            ->expects(self::once())
            ->method('getRate')
            ->willReturn(2);

        $result = $this->commissionCalculator->calculate($input);

        self::assertCount(1, $result);
        self::assertEquals($expectedResult, reset($result));
    }
}
