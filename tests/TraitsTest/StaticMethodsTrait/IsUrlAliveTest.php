<?php

declare(strict_types=1);

namespace KEINOS\Tests;

use KEINOS\MSTDN_TOOLS\Config\StaticMethodsTrait;

final class IsUrlAliveTest extends TestCase
{
    public function testExistingUrl()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = 'https://yahoo.co.jp/';
        $this->assertTrue($mock->isUrlAlive($value));
    }

    public function testNonExistingUrl()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $dummy = hash('sha256', strval(time()));
        $value = "https://foobar${dummy}.com/";
        $this->assertFalse($mock->isStringAlphaNumeric($value));
    }
}
