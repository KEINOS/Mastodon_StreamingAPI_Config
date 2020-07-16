<?php

declare(strict_types=1);

namespace KEINOS\Tests;

use KEINOS\MSTDN_TOOLS\Config\StaticMethodsTrait;

final class IsStringAlphaNumericTest extends TestCase
{
    public function testStringInput()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = hash('md5', strval(time()));
        $this->assertTrue($mock->isStringAlphaNumeric($value));
    }

    public function testIntegerInput()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = intval(time());
        $this->expectException(\TypeError::class);
        $mock->isStringAlphaNumeric($value);
    }
}
