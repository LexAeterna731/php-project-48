<?php

namespace Hexlet\Code\Formatter;

use function Hexlet\Code\Formatters\Stylish\stylishFormat;
use function Hexlet\Code\Formatters\Plain\plainFormat;

function formatDiff(array $diff, string $format): string
{
    if ($format === 'stylish') {
        $result = stylishFormat($diff);
    } elseif ($format === 'plain') {
        $result = plainFormat($diff);
    }

    return $result;
}
