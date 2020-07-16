<?php

declare(strict_types=1);

namespace KEINOS\Tests;

use KEINOS\MSTDN_TOOLS\Config\StaticMethodsTrait;

final class IsCompliantAccessTokenTest extends TestCase
{
    public function testEmptyValue()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = '';
        $this->assertFalse($mock->isCompliantAccessToken($value));
    }

    public function testNonAlphaNumeric()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = hash('sha512', strval(time()));
        $value[0] = '-';
        $this->assertFalse($mock->isCompliantAccessToken($value));
    }

    public function testSha512Hash()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = hash('sha512', strval(time()));
        $this->assertFalse($mock->isCompliantAccessToken($value));
    }

    public function testSha256Hash()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        // SHA256 is 64byte length hash
        $value = hash('sha256', strval(time()));
        $this->assertTrue($mock->isCompliantAccessToken($value));
    }

    public function testMd5Hash()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = hash('md5', strval(time()));
        $this->assertFalse($mock->isCompliantAccessToken($value));
    }

    public function testIntegerInput()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = intval(time());
        $this->expectException(\TypeError::class);
        $mock->isCompliantAccessToken($value);
    }
}
