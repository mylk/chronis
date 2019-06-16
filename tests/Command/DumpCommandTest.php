<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Chronis\Command\DumpCommand;
use Chronis\Exception\InvalidCommandInputException;

class DumpCommandTest extends TestCase
{
    private static $dumpCommand = null;

    public static function setUpBeforeClass(): void
    {
        $containerBuilder = new ContainerBuilder();
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
        $loader->load("../../config/services.yaml");

        self::$dumpCommand = new DumpCommand();
        self::$dumpCommand->setContainer($containerBuilder);
    }

    public function testExecuteThrowsExceptionWhenConfigOptionNotSet(): void
    {
        $this->expectException(InvalidCommandInputException::class);
        $this->expectExceptionMessage("Option --config is missing.");

        $commandTester = new CommandTester(self::$dumpCommand);
        $commandTester->execute([]);
    }

    public function testExecuteDumpsCrontab(): void
    {
        $commandTester = new CommandTester(self::$dumpCommand);
        $commandTester->execute([
            "--config" => __DIR__ . "/../../config/chronis.example.yaml",
        ]);

        $output = $commandTester->getDisplay();
        $expected = <<<EOF
# foo: Lists /tmp
* * * * * ls -la /tmp

# bar: Lists home directory
0 10 * * * ls -la ~

EOF;
        $this->assertStringContainsString($expected, $output);
    }
}
