<?php

use PHPUnit\Framework\TestCase;
use Chronis\Model\CronJob;

class CronJobTest extends TestCase
{
    private static $cronJob = null;

    public static function setUpBeforeClass() : void
    {
        self::$cronJob = new CronJob();
    }

    public function testGetCommandWhenNotSet() : void
    {
        $this->assertNull(self::$cronJob->getCommand());
    }

    public function testGetCommandWhenSet() : void
    {
        $model = self::$cronJob->setCommand("foo");
        $this->assertInstanceOf(CronJob::class, $model);
        $this->assertEquals("foo", self::$cronJob->getCommand());
    }

    public function testGetDescriptionWhenNotSet() : void
    {
        $this->assertNull(self::$cronJob->getDescription());
    }

    public function testGetDescriptionWhenSet() : void
    {
        $model = self::$cronJob->setDescription("foo");
        $this->assertInstanceOf(CronJob::class, $model);
        $this->assertEquals("foo", self::$cronJob->getDescription());
    }

    public function testGetExpressionWhenNotSet() : void
    {
        $this->assertNull(self::$cronJob->getExpression());
    }

    public function testGetExpressionWhenSet() : void
    {
        $model = self::$cronJob->setExpression("foo");
        $this->assertInstanceOf(CronJob::class, $model);
        $this->assertEquals("foo", self::$cronJob->getExpression());
    }

    public function testGetNameWhenNotSet() : void
    {
        $this->assertNull(self::$cronJob->getName());
    }

    public function testGetNameWhenSet() : void
    {
        $model = self::$cronJob->setName("foo");
        $this->assertInstanceOf(CronJob::class, $model);
        $this->assertEquals("foo", self::$cronJob->getName());
    }
}
