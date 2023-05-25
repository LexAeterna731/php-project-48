<?php

namespace Differ\Formatter;

use function Differ\Formatters\Stylish\stylishFormat;
use function Differ\Formatters\Plain\plainFormat;
use function Differ\Formatters\Json\jsonFormat;

function formatDiff(array $diff, string $format): string
{
    if ($format === 'stylish') {
        $result = stylishFormat($diff);
    } elseif ($format === 'plain') {
        $result = plainFormat($diff);
    } elseif ($format === 'json') {
        $result = jsonFormat($diff);
    } else {
        $result = "Wrong format. Use 'gendiff -h' for more information";
    }

    return $result;
}
