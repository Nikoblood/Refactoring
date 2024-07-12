<?php

namespace App\Service\Bin;

use LogicException;
use Throwable;

class BinProvider implements BinProviderInterface
{
    private const string URL = 'https://lookup.binlist.net/';

    /**
     * @throws LogicException
     */
    public function getCountryCode(string $bin): string
    {
        try {
            $json = file_get_contents(sprintf('%s%s', self::URL, $bin));
            $result = json_decode((string) $json, true, 512, JSON_THROW_ON_ERROR);

            return $result['country']['alpha2'];
        } catch (Throwable $exception) {
            throw new LogicException(
                sprintf('Error during retrieving info by BIN %s', $bin),
                previous: $exception,
            );
        }
    }
}
