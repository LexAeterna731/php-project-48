<?php

namespace Differ\Differ;

use function Differ\Parcer\getData;
use function Differ\DiffArray\makeDiffArray;
use function Differ\Formatter\formatDiff;

function genDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{
    $firstFile = getData($firstFilePath);
    $secondFile = getData($secondFilePath);
    $diff = makeDiffArray($firstFile, $secondFile);
    $result = formatDiff($diff, $format);

    return $result;
}
