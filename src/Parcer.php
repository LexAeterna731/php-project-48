<?php

namespace Hexlet\Code\Parcer;

use Symfony\Component\Yaml\Yaml;

function getData($filePath): array
{
    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
    if ($fileExtension === "json") {
        $fileData = parceJson($filePath);
    } elseif ($fileExtension === "yml" || $fileExtension === "yaml") {
        $fileData = parceYml($filePath);
    }

    return $fileData;
}

function parceJson($pathToJson): array
{
    return json_decode(file_get_contents(realpath($pathToJson)), true);
}

function parceYml($pathToYml): array
{
    return Yaml::parseFile($pathToYml); //доработать с флагом Yaml::PARSE_OBJECT_FOR_MAP
}
