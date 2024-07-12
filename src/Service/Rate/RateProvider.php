<?php

namespace App\Service\Rate;

use LogicException;
use Throwable;

class RateProvider implements RateProviderInterface
{
    private const string URL = 'https://api.exchangeratesapi.io/latest';

    /**
     * @throws LogicException
     */
    public function getRate(string $currency): int
    {
        try {
            $json = file_get_contents(self::URL);

            $rates = json_decode((string) $json, true, 512, JSON_THROW_ON_ERROR);

            return (int) $rates['rates'][$currency];
        } catch (Throwable $exception) {
            throw new LogicException(
                sprintf('Error during retrieving rate by currency %s', $currency),
                previous: $exception,
            );
        }
    }
}
