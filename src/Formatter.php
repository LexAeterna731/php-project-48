<?php

namespace Hexlet\Code\Formatter;

use function Hexlet\Code\Formatters\Stylish\stylishFormat;

function formatDiff(array $diff, string $format): string
{
    if ($format === 'stylish') {
        $result = stylishFormat($diff);
    }

    return $result;
}
