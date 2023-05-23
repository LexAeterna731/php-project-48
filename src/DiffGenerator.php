<?php

namespace Hexlet\Code\DiffGenerator;

use function Hexlet\Code\Parcer\getData;
use function Hexlet\Code\DiffArray\makeDiffArray;
use function Hexlet\Code\Formatter\formatDiff;

function generateDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{
    $firstFile = getData($firstFilePath);
    $secondFile = getData($secondFilePath);
    $diff = makeDiffArray($firstFile, $secondFile);
    $result = formatDiff($diff, $format);

    return $result;
}
