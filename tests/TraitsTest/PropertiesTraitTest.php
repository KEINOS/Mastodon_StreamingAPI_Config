<?php

declare(strict_types=1);

namespace KEINOS\Tests;

use KEINOS\MSTDN_TOOLS\Config\PropertiesTrait;

/**
 * Tests for Getter/Setter methods of the properties in trait.
 */
final class PropertiesTraitTest extends TestCase
{
    public function testSetAndGetAccessToken()
    {
        $mock = $this->getMockForTrait(PropertiesTrait::class);

        $expect = hash('md5', strval(mt_rand()));
        $mock->setAccessToken($expect);
        $actual = $mock->getAccessToken();

        $this->assertSame($expect, $actual);
    }

    public function testSetAndGetEndpointApiInstance()
    {
        $mock = $this->getMockForTrait(PropertiesTrait::class);

        $expect = hash('md5', strval(mt_rand()));
        $mock->setEndpointApiInstance($expect);
        $actual = $mock->getEndpointApiInstance();

        $this->assertSame($expect, $actual);
    }

    public function testSetAndGetFlagUseCache()
    {
        $mock = $this->getMockForTrait(PropertiesTrait::class);

        $expect = true;
        $mock->setFlagUseCache($expect);
        $actual = $mock->getFlagUseCache();

        $this->assertSame($expect, $actual);
    }

    public function testSetAndGetIdHashSelf()
    {
        $mock = $this->getMockForTrait(PropertiesTrait::class);

        $expect = hash('md5', strval(mt_rand()));
        $mock->setIdHashSelf($expect);
        $actual = $mock->getIdHashSelf();

        $this->assertSame($expect, $actual);
    }

    public function testSetAndGetInfoInstance()
    {
        $mock = $this->getMockForTrait(PropertiesTrait::class);

        $key_dummy   = hash('md5', strval(mt_rand()));
        $value_dummy = hash('md5', strval(mt_rand()));

        $expect = [
            $key_dummy => $value_dummy,
        ];
        $mock->setInfoInstance($expect);
        $actual = $mock->getInfoInstance();

        $this->assertSame($expect, $actual);
    }

    public function testSetAndGetPrefixCache()
    {
        $mock = $this->getMockForTrait(PropertiesTrait::class);

        $expect = hash('md5', strval(mt_rand()));
        $mock->setPrefixCache($expect);
        $actual = $mock->getPrefixCache();

        $this->assertSame($expect, $actual);
    }

    public function testSetAndGetTtlCache()
    {
        $mock = $this->getMockForTrait(PropertiesTrait::class);

        $expect = intval(mt_rand());
        $mock->setTtlCache($expect);
        $actual = $mock->getTtlCache();

        $this->assertSame($expect, $actual);
    }

    public function testSetAndGetUrlHost()
    {
        $mock = $this->getMockForTrait(PropertiesTrait::class);

        $expect = 'https://sample.com/';
        $mock->setUrlHost($expect);
        $actual = $mock->getUrlHost();

        $this->assertSame($expect, $actual);
    }

    public function testSetAndGetUrlApiInstance()
    {
        $mock = $this->getMockForTrait(PropertiesTrait::class);

        $expect = 'https://sample.com/';
        $mock->setUrlApiInstance($expect);
        $actual = $mock->getUrlApiInstance();

        $this->assertSame($expect, $actual);
    }
}
