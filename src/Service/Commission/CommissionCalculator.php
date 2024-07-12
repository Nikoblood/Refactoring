<?php

namespace App\Service\Commission;

use App\Model\Constant\AmountMultiplier;
use App\Model\DTO\InputRow;
use App\Service\Bin\BinProviderInterface;
use App\Service\Rate\RateProviderInterface;

final readonly class CommissionCalculator
{
    private const array EU_COUNTRY_CODES = [
        'AT',
        'BE',
        'BG',
        'CY',
        'CZ',
        'DE',
        'DK',
        'EE',
        'ES',
        'FI',
        'FR',
        'GR',
        'HR',
        'HU',
        'IE',
        'IT',
        'LT',
        'LU',
        'LV',
        'MT',
        'NL',
        'PO',
        'PT',
        'RO',
        'SE',
        'SI',
        'SK',
    ];

    public function __construct(
        private BinProviderInterface $binProvider,
        private RateProviderInterface $rateProvider,
    )
    {
    }

    /**
     * @param InputRow[] $inputRows
     *
     * @return float[]
     */
    public function calculate(array $inputRows): array
    {
        $result = [];

        foreach ($inputRows as $inputRow) {
            $countryCode = $this->binProvider->getCountryCode($inputRow->bin);
            $rate = $this->rateProvider->getRate($inputRow->currency);

            // original code has bug here - when rate is 0 and currency is not 'EUR' - we will catch divide by 0
            $amount = $rate > 0 ? $inputRow->amount / $rate : $inputRow->amount;

            $multiplier = in_array($countryCode, self::EU_COUNTRY_CODES, true)
                ? AmountMultiplier::EU_MULTIPLIER->value
                : AmountMultiplier::OTHER_MULTIPLIER->value;

            $result[] = round($amount * (float) $multiplier, 2);
        }

        return $result;
    }
}
