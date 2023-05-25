<?php

namespace Hexlet\Code\Formatters\Plain;

use function Hexlet\Code\StringConverter\convertToString;

function plainFormat(array $diff): string
{
    $iter = function ($currentDiff, $way = null) use (&$iter) {
        $iterMap = array_map(function ($key, $value) use ($way, $iter) {
            $currentWay = $way ? "{$way}.{$key}" : "{$key}";
            $singleDiffSize = count($value);
            $singleKeyDiff = array_map(function ($diffKey, $diffValue) use ($currentWay, $singleDiffSize, $iter) {
                if ($diffKey === '') {
                    if (!is_array($diffValue)) {
                        $singleDiffItem = null;
                    } else {
                        $singleDiffItem = $iter($diffValue, $currentWay);
                    }
                } else {
                    $currentValue = is_array($diffValue) ? "[complex value]" :
                                    (is_string($diffValue) ? "'" . convertToString($diffValue) . "'" :
                                    convertToString($diffValue));

                    if ($singleDiffSize === 1) {
                        if ($diffKey === "-") {
                            $singleDiffItem = "Property '{$currentWay}' was removed";
                        } elseif ($diffKey === "+") {
                            $singleDiffItem = "Property '{$currentWay}' was added with value: {$currentValue}";
                        }
                    } elseif ($singleDiffSize === 2) {
                        if ($diffKey === "-") {
                            $singleDiffItem = "Property '{$currentWay}' was updated. From {$currentValue} to ";
                        } elseif ($diffKey === "+") {
                            $singleDiffItem = "{$currentValue}";
                        }
                    }
                }

                return $singleDiffItem;
            }, array_keys($value), $value);

            return implode("", $singleKeyDiff);
        }, array_keys($currentDiff), $currentDiff);
        $iterMapNoNull = array_diff($iterMap, array(null));

        return implode("\n", $iterMapNoNull);
    };

    $result = $iter($diff);

    return $result;
}
