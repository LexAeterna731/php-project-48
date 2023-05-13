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

        $resultJson = generateDiff($pathToJson1, $pathToJson2);
        $resultYml = generateDiff($pathToYml1, $pathToYml2);
        $expected = file_get_contents($pathToExpected);

        $this->assertEquals($expected, $resultJson);
        $this->assertEquals($expected, $resultYml);
    }
}
