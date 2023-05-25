<?php

namespace Hexlet\Code\Formatter;

use function Hexlet\Code\Formatters\Stylish\stylishFormat;
use function Hexlet\Code\Formatters\Plain\plainFormat;
use function Hexlet\Code\Formatters\Json\jsonFormat;

function formatDiff(array $diff, string $format): string
{
    if ($format === 'stylish') {
        $result = stylishFormat($diff);
    } elseif ($format === 'plain') {
        $result = plainFormat($diff);
    } elseif ($format === 'json') {
        $result = jsonFormat($diff);
    }

    return $result;
}
