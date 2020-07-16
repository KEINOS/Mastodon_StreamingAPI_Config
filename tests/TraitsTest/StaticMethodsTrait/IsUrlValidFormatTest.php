<?php

declare(strict_types=1);

namespace KEINOS\Tests;

use KEINOS\MSTDN_TOOLS\Config\StaticMethodsTrait;

final class IsUrlValidFormatTest extends TestCase
{
    public function testTypicalUrl()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = 'https://yahoo.co.jp/';
        $this->assertTrue($mock->isUrlValidFormat($value));
    }

    public function testSecureWebSocketScheme()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = 'wss://yahoo.co.jp/';
        $this->assertTrue($mock->isUrlValidFormat($value));
    }

    public function testNonExistingUrl()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = 'https:/yahoo.co.jp/';
        $this->assertFalse($mock->isUrlValidFormat($value));
    }
}
