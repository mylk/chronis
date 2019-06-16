<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Chronis\Command\ContainerAwareCommand;

class FooCommand extends ContainerAwareCommand
{
}

class ContainerAwareCommandTest extends TestCase
{
    private static $fooCommand = null;

    public static function setUpBeforeClass(): void
    {
        self::$fooCommand = new FooCommand();
    }

    public function testGetContainerReturnsContainer(): void
    {
        $container = new ContainerBuilder();
        $command = self::$fooCommand->setContainer($container);
        $this->assertInstanceOf(FooCommand::class, $command);
        $this->assertSame($container, self::$fooCommand->getContainer());
    }
}
