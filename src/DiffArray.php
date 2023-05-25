<?php

namespace Differ\DiffArray;

use function Functional\sort;

function makeDiffArray(array $firstArray, array $secondArray): array
{
    $firstKeysArray = array_keys($firstArray);
    $secondKeysArray = array_keys($secondArray);
    $keysArray = array_merge($firstKeysArray, $secondKeysArray);
    $uniqueKeys = sort(array_unique($keysArray), fn ($key1, $key2) => strcmp($key1, $key2));

    $resultArray = array_reduce($uniqueKeys, function ($acc, $key) use ($firstArray, $secondArray) {
        return array_merge($acc, compareDiff($key, $firstArray, $secondArray));
    }, []);

    return $resultArray;
}

function compareDiff(string $key, array $firstArray, array $secondArray): array
{
    $firstVal = array_key_exists($key, $firstArray) ? $firstArray[$key] : null;
    $secondVal = array_key_exists($key, $secondArray) ? $secondArray[$key] : null;

    if (!array_key_exists($key, $firstArray)) {
        $comparedElement = [
            $key => [
                "+" => is_array($secondVal) ? makeDiffArray($secondVal, $secondVal) : $secondVal
            ]
        ];
    } elseif (!array_key_exists($key, $secondArray)) {
        $comparedElement = [
            $key => [
                "-" => is_array($firstVal) ? makeDiffArray($firstVal, $firstVal) : $firstVal
            ]
        ];
    } elseif (is_array($firstVal) && is_array($secondVal)) {
        $comparedElement = [
            $key => [
                "" => makeDiffArray($firstVal, $secondVal)
            ]
        ];
    } elseif ($firstVal === $secondVal) {
        $comparedElement = [
            $key => [
                "" => $firstVal
            ]
        ];
    } else {
        $comparedElement = [
            $key => [
                "-" => is_array($firstVal) ? makeDiffArray($firstVal, $firstVal) : $firstVal,
                "+" => is_array($secondVal) ? makeDiffArray($secondVal, $secondVal) : $secondVal
            ]
        ];
    }

    return $comparedElement;
}
