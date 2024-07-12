<?php

namespace App\Service\Bin;

interface BinProviderInterface
{
    public function getCountryCode(string $bin): string;
}
