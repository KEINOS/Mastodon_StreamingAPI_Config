<?php

declare(strict_types=1);

namespace KEINOS\Tests;

use KEINOS\MSTDN_TOOLS\Config\StaticMethodsTrait;

final class IsUrlProtocolHttpTest extends TestCase
{
    public function testUrlAsHttp()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = 'http://yahoo.co.jp/';
        $this->assertTrue($mock->isUrlProtocolHttp($value));
    }

    public function testUrlAsHttps()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = 'https://yahoo.co.jp/';
        $this->assertFalse($mock->isUrlProtocolHttp($value));
    }

    public function testUrlAsFtp()
    {
        $mock = $this->getMockForTrait(StaticMethodsTrait::class);

        $value = 'ftp://yahoo.co.jp/';
        $this->assertFalse($mock->isUrlProtocolHttp($value));
    }
}
