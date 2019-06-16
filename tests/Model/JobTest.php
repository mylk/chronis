<?php

use PHPUnit\Framework\TestCase;
use Chronis\Model\Job;

class FooJob extends Job
{
}

class JobTest extends TestCase
{
    private static $fooJob = null;

    public static function setUpBeforeClass() : void
    {
        self::$fooJob = new FooJob();
    }

    public function testGetCommandWhenNotSet() : void
    {
        $this->assertNull(self::$fooJob->getCommand());
    }

    public function testGetCommandWhenSet() : void
    {
        $model = self::$fooJob->setCommand("foo");
        $this->assertInstanceOf(FooJob::class, $model);
        $this->assertEquals("foo", self::$fooJob->getCommand());
    }

    public function testGetDescriptionWhenNotSet() : void
    {
        $this->assertNull(self::$fooJob->getDescription());
    }

    public function testGetDescriptionWhenSet() : void
    {
        $model = self::$fooJob->setDescription("foo");
        $this->assertInstanceOf(FooJob::class, $model);
        $this->assertEquals("foo", self::$fooJob->getDescription());
    }

    public function testGetExpressionWhenNotSet() : void
    {
        $this->assertNull(self::$fooJob->getExpression());
    }

    public function testGetExpressionWhenSet() : void
    {
        $model = self::$fooJob->setExpression("foo");
        $this->assertInstanceOf(FooJob::class, $model);
        $this->assertEquals("foo", self::$fooJob->getExpression());
    }

    public function testGetNameWhenNotSet() : void
    {
        $this->assertNull(self::$fooJob->getName());
    }

    public function testGetNameWhenSet() : void
    {
        $model = self::$fooJob->setName("foo");
        $this->assertInstanceOf(FooJob::class, $model);
        $this->assertEquals("foo", self::$fooJob->getName());
    }
}
