<?php

declare(strict_types=1);

namespace KEINOS\Tests;

final class ConstructorTest extends TestCase
{
    public function testExistingHost()
    {
        $expect = 'https://qiitadon.com/';
        $conf = new \KEINOS\MSTDN_TOOLS\Config($expect);
        $actual = $conf->getUrlHost();
        $this->assertSame($expect, $actual);
    }

    public function testNullArgument()
    {
        $this->expectException(\TypeError::class);
        $conf = new \KEINOS\MSTDN_TOOLS\Config();
    }

    public function testInvalidPathArgument()
    {
        $url_host = 'https://qiitadon.com/api';

        $this->expectException(\Exception::class);
        $conf = new \KEINOS\MSTDN_TOOLS\Config($url_host);
    }
}
