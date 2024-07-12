<?php

namespace App\Service\Rate;

interface RateProviderInterface
{
    public function getRate(string $currency): int;
}
