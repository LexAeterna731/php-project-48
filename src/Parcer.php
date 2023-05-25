<?php

namespace Differ\Parcer;

use Symfony\Component\Yaml\Yaml;

function getData(mixed $filePath)
{
    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
    if ($fileExtension === "json") {
        $fileData = parceJson($filePath);
    } elseif ($fileExtension === "yml" || $fileExtension === "yaml") {
        $fileData = parceYml($filePath);
    } else {
        $fileData = null;
    }

    return $fileData;
}

function parceJson(mixed $pathToJson): array
{
    $data = realpath($pathToJson);
    if ($data === false) {
        return [];
    }

    return json_decode(file_get_contents($data), true);
}

function parceYml(mixed $pathToYml): array
{
    $object = Yaml::parseFile($pathToYml, Yaml::PARSE_OBJECT_FOR_MAP);
    $data = json_encode($object);
    if ($data === false) {
        return [];
    }

    return json_decode($data, true);
}
