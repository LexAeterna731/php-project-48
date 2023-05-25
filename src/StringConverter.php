<?php

namespace Hexlet\Code\StringConverter;

function convertToString($currentValue)
{
    $result = !isset($currentValue) ? 'null' :
              (is_bool($currentValue) ? ($currentValue ? "true" : "false") : $currentValue);
    return $result;
}
