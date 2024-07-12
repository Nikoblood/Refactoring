<?php

namespace App\Tests\Service\Input;

use App\Model\DTO\InputRow;
use App\Service\Input\JsonInputParser;
use PHPUnit\Framework\TestCase;

class JsonInputParserTest extends TestCase
{
    private JsonInputParser $jsonInputParser;

    protected function setUp(): void
    {
        $this->jsonInputParser = new JsonInputParser();
    }

    public function testParse(): void
    {
        $expectedResult = [
            new InputRow(100.00, 'EUR', '45717360'),
            new InputRow(50.00, 'USD', '516793'),
        ];

        $result = $this->jsonInputParser->parse(__DIR__ . '/test_input.txt');

        self::assertEquals($expectedResult, $result);
    }
}
