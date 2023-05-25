<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Hexlet\Code\DiffGenerator\generateDiff;

class DiffGeneratorTest extends TestCase
{
    private $pathToJson1;
    private $pathToJson2;
    private $pathToYml1;
    private $pathToYml2;
    private $pathToExpected;

    private function getFixturePath($fixtureName): string
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return implode('/', $parts);
    }

    public function testDiffGenerator(): void
    {
        $pathToJson1 = $this->getFixturePath('file1.json');
        $pathToJson2 = $this->getFixturePath('file2.json');
        $pathToYml1 = $this->getFixturePath('file1.yml');
        $pathToYml2 = $this->getFixturePath('file2.yml');
        $pathToExpected = $this->getFixturePath('expected.txt');
        $pathToPlain = $this->getFixturePath('plain.txt');
        $pathToJson = $this->getFixturePath('json.txt');

        $resultJson = generateDiff($pathToJson1, $pathToJson2);
        $resultYml = generateDiff($pathToYml1, $pathToYml2);
        $expected = file_get_contents($pathToExpected);

        $resultJsonPlain = generateDiff($pathToJson1, $pathToJson2, 'plain');
        $resultYmlPlain = generateDiff($pathToYml1, $pathToYml2, 'plain');
        $plain = file_get_contents($pathToPlain);

        $resultJsonJson = generateDiff($pathToJson1, $pathToJson2, 'json');
        $resultYmlJson = generateDiff($pathToYml1, $pathToYml2, 'json');
        $json = file_get_contents($pathToJson);

        $this->assertEquals($expected, $resultJson);
        $this->assertEquals($expected, $resultYml);

        $this->assertEquals($plain, $resultJsonPlain);
        $this->assertEquals($plain, $resultYmlPlain);

        $this->assertEquals($json, $resultJsonJson);
        $this->assertEquals($json, $resultYmlJson);
    }
}
