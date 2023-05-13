<?php

namespace Hexlet\Code\DiffGenerator;

use function Hexlet\Code\Parcer\getData;

function isBoolean($value)
{
    $result = $value;

    if (is_bool($result)) {
        $result = $result ? "true" : "false";
    }

    return $result;
}

function compareDiff($key, $firstFile, $secondFile)
{
    $firstVal = isBoolean($firstFile[$key] ?? null);
    $secondVal = isBoolean($secondFile[$key] ?? null);

    if (!array_key_exists($key, $firstFile)) {
        $comparedString = "  + {$key}: {$secondVal}";
    } elseif (!array_key_exists($key, $secondFile)) {
        $comparedString = "  - {$key}: {$firstVal}";
    } elseif ($firstVal === $secondVal) {
        $comparedString = "    {$key}: {$firstVal}";
    } else {
        $comparedString = "  - {$key}: {$firstVal}\n  + {$key}: {$secondVal}";
    }

    return $comparedString;
}

function generateDiff(string $firstFilePath, string $secondFilePath)
{
    $firstFile = getData($firstFilePath);
    $secondFile = getData($secondFilePath);

    $firstKeysArray = array_keys($firstFile);
    $secondKeysArray = array_keys($secondFile);
    $keysArray = array_merge($firstKeysArray, $secondKeysArray);
    $uniqueKeys = array_unique($keysArray);
    sort($uniqueKeys);

    $resultArray = array_reduce($uniqueKeys, function ($acc, $key) use ($firstFile, $secondFile) {
        return array_merge($acc, [compareDiff($key, $firstFile, $secondFile)]);
    }, []);

    $result = implode("\n", $resultArray);

    return "{\n{$result}\n}\n";
}
