<?php

namespace Differ\StringConverter;

function convertToString(mixed $currentValue)
{
    $result = !isset($currentValue) ? 'null' :
              (is_bool($currentValue) ? ($currentValue ? "true" : "false") : $currentValue);
    return $result;
}
