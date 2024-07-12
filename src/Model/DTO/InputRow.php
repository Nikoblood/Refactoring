<?php

namespace App\Model\DTO;

final readonly class InputRow
{
    public function __construct(
        public float $amount,
        public string $currency,
        public string $bin,
    )
    {
    }
}
