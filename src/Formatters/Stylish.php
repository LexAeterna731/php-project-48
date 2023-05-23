<?php

namespace Hexlet\Code\Formatters\Stylish;

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
                    $line = "{$indent}{$key}: {$diffValue}";
                }

                return $line;
            }, array_keys($value), $value);

            return implode("\n", $singleKeyDiff);
        }, array_keys($currentDiff), $currentDiff);

        return implode("\n", $iterMap);
    };

    $formattedResult = $iter($diff, 1);

    return "{\n{$formattedResult}\n}\n";
}

function makeIndent(int $level, string $symbol = ''): string
{
    $firstPart = str_repeat("  ", $level * 2 - 1);
    $lastPart = $symbol === '' ? "  " : "{$symbol} ";

    return "{$firstPart}{$lastPart}";
}
