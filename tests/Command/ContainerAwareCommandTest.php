<?php

use PHPUnit\Framework\TestCase;
use Chronis\Command\ContainerAwareCommand;

class FooCommand extends ContainerAwareCommand
{
}

class ContainerAwareCommandTest extends TestCase
{
    private static $fooCommand = null;

    public static function setUpBeforeClass() : void
    {
        self::$fooCommand = new FooCommand();
    }

    public function testGetContainerWhenNotSet() : void
    {
        $this->assertNull(self::$fooCommand->getContainer());
    }

    public function testGetContainerWhenSet() : void
    {
        $command = self::$fooCommand->setContainer("foo");
        $this->assertInstanceOf(FooCommand::class, $command);
        $this->assertEquals("foo", self::$fooCommand->getContainer());
    }
}
