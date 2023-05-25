<?php

namespace Differ\Parcer;

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
    $object = Yaml::parseFile($pathToYml, Yaml::PARSE_OBJECT_FOR_MAP);

    return json_decode(json_encode($object), true);
}
