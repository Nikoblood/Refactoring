<?php

use App\Service\Input\JsonInputParser;
use App\Service\Commission\CommissionCalculator;
use App\Service\Bin\BinProvider;
use App\Service\Rate\RateProvider;

require __DIR__ . '/vendor/autoload.php';

$jsonInputParser = new JsonInputParser();

$commissionCalculator = new CommissionCalculator(
    new BinProvider(),
    new RateProvider(),
);

$result = $commissionCalculator->calculate($jsonInputParser->parse($argv[1]));

foreach ($result as $value) {
    print sprintf("%d\n", $value);
}
