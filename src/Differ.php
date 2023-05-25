<?php

namespace Differ\Differ;

use function Differ\Parcer\getData;
use function Differ\DiffArray\makeDiffArray;
use function Differ\Formatter\formatDiff;

function genDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{
    $firstFile = getData($firstFilePath);
    $secondFile = getData($secondFilePath);
    if (!isset($firstFile) || !isset($secondFile)) {
        return "Unsupported file extension. Use 'gendiff -h' for more information";
    }
    $diff = makeDiffArray($firstFile, $secondFile);
    $result = formatDiff($diff, $format);

    return $result;
}
