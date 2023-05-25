<?php

namespace Differ\Formatters\Stylish;

use function Differ\StringConverter\convertToString;

function stylishFormat(array $diff): string
{
    $iter = function ($currentDiff, $level) use (&$iter) {
        $iterMap = array_map(function ($key, $value) use ($level, $iter) {
            $singleKeyDiff = array_map(function ($diffKey, $diffValue) use ($key, $level, $iter) {
                $indent = makeIndent($level, $diffKey);
                if (is_array($diffValue)) {
                    $arrayDiffValue = $iter($diffValue, $level + 1);
                    $indentEnd = makeIndent($level);
                    $line = "{$indent}{$key}: {\n{$arrayDiffValue}\n{$indentEnd}}";
                } else {
                    $stringDiffValue = convertToString($diffValue);
                    $line = "{$indent}{$key}: {$stringDiffValue}";
                }

                return $line;
            }, array_keys($value), $value);

            return implode("\n", $singleKeyDiff);
        }, array_keys($currentDiff), $currentDiff);

        return implode("\n", $iterMap);
    };

    $formattedResult = $iter($diff, 1);

    return "{\n{$formattedResult}\n}";
}

function makeIndent(int $level, string $symbol = ''): string
{
    $firstPart = str_repeat("  ", $level * 2 - 1);
    $lastPart = $symbol === '' ? "  " : "{$symbol} ";

    return "{$firstPart}{$lastPart}";
}
