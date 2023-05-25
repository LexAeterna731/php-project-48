<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
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

    public function testDiffer(): void
    {
        $pathToJson1 = $this->getFixturePath('file1.json');
        $pathToJson2 = $this->getFixturePath('file2.json');
        $pathToYml1 = $this->getFixturePath('file1.yml');
        $pathToYml2 = $this->getFixturePath('file2.yml');
        $pathToExpected = $this->getFixturePath('expected.txt');
        $pathToPlain = $this->getFixturePath('plain.txt');
        $pathToJson = $this->getFixturePath('json.txt');

        $resultJson = genDiff($pathToJson1, $pathToJson2);
        $resultYml = genDiff($pathToYml1, $pathToYml2);
        $expected = file_get_contents($pathToExpected);

        $resultJsonPlain = genDiff($pathToJson1, $pathToJson2, 'plain');
        $resultYmlPlain = genDiff($pathToYml1, $pathToYml2, 'plain');
        $plain = file_get_contents($pathToPlain);

        $resultJsonJson = genDiff($pathToJson1, $pathToJson2, 'json');
        $resultYmlJson = genDiff($pathToYml1, $pathToYml2, 'json');
        $json = file_get_contents($pathToJson);

        $this->assertEquals($expected, $resultJson);
        $this->assertEquals($expected, $resultYml);

        $this->assertEquals($plain, $resultJsonPlain);
        $this->assertEquals($plain, $resultYmlPlain);

        $this->assertEquals($json, $resultJsonJson);
        $this->assertEquals($json, $resultYmlJson);
    }
}
