<?php

namespace App\Service\Input;

use App\Model\DTO\InputRow;
use LogicException;
use Throwable;

class JsonInputParser
{
    /**
     * @return InputRow[]
     */
    public function parse(string $filePath): array
    {
        $result = [];

        try {
            $inputData = array_map('trim', explode("\n", (string) file_get_contents($filePath)));

            foreach ($inputData as $row) {
                if (empty($row)) {
                    break;
                }

                $json = json_decode($row, true, 512, JSON_THROW_ON_ERROR);

                $result[] = new InputRow((float) $json['amount'], $json['currency'], $json['bin']);
            }

            return $result;
        } catch (Throwable $exception) {
            throw new LogicException('Error during parse input file', previous: $exception);
        }
    }
}
