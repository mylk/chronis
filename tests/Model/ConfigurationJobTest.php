<?php

use PHPUnit\Framework\TestCase;
use Chronis\Model\ConfigurationJob;

class ConfigurationJobTest extends TestCase
{
    private static $configurationJob = null;

    public static function setUpBeforeClass() : void
    {
        self::$configurationJob = new ConfigurationJob();
    }

    public function testGetCommandWhenNotSet() : void
    {
        $this->assertNull(self::$configurationJob->getCommand());
    }

    public function testGetCommandWhenSet() : void
    {
        $model = self::$configurationJob->setCommand("foo");
        $this->assertInstanceOf(ConfigurationJob::class, $model);
        $this->assertEquals("foo", self::$configurationJob->getCommand());
    }

    public function testGetDescriptionWhenNotSet() : void
    {
        $this->assertNull(self::$configurationJob->getDescription());
    }

    public function testGetDescriptionWhenSet() : void
    {
        $model = self::$configurationJob->setDescription("foo");
        $this->assertInstanceOf(ConfigurationJob::class, $model);
        $this->assertEquals("foo", self::$configurationJob->getDescription());
    }

    public function testGetExpressionWhenNotSet() : void
    {
        $this->assertNull(self::$configurationJob->getExpression());
    }

    public function testGetExpressionWhenSet() : void
    {
        $model = self::$configurationJob->setExpression("foo");
        $this->assertInstanceOf(ConfigurationJob::class, $model);
        $this->assertEquals("foo", self::$configurationJob->getExpression());
    }

    public function testGetNameWhenNotSet() : void
    {
        $this->assertNull(self::$configurationJob->getName());
    }

    public function testGetNameWhenSet() : void
    {
        $model = self::$configurationJob->setName("foo");
        $this->assertInstanceOf(ConfigurationJob::class, $model);
        $this->assertEquals("foo", self::$configurationJob->getName());
    }

    public function testGetTypeNotSet() : void
    {
        $this->assertNull(self::$configurationJob->getType());
    }

    public function testGetTypeWhenSet() : void
    {
        $model = self::$configurationJob->setType("foo");
        $this->assertInstanceOf(ConfigurationJob::class, $model);
        $this->assertEquals("foo", self::$configurationJob->getType());
    }
}
