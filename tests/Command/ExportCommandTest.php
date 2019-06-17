<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Chronis\Command\ExportCommand;
use Chronis\Exception\InvalidCommandInputException;

class ExportCommandTest extends TestCase
{
    private static $exportCommand = null;

    public static function setUpBeforeClass(): void
    {
        $containerBuilder = new ContainerBuilder();
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
        $loader->load("../../config/services.yaml");

        self::$exportCommand = new ExportCommand();
        self::$exportCommand->setContainer($containerBuilder);
    }

    public function setUp(): void
    {
        $outputFiles = ["crontab", "/tmp/chrnis_test_export"];
        foreach ($outputFiles as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    public function testExecuteThrowsExceptionWhenConfigOptionNotSet(): void
    {
        $this->expectException(InvalidCommandInputException::class);
        $this->expectExceptionMessage("Option --config is missing.");

        $commandTester = new CommandTester(self::$exportCommand);
        $commandTester->execute([]);
    }

    public function testExecuteWritesCrontabToDefaultFile(): void
    {
        $commandTester = new CommandTester(self::$exportCommand);
        $commandTester->execute([
            "--config" => __DIR__ . "/../../config/chronis.example.yaml",
        ]);

        $this->assertEquals("Crontab successfully exported to file \"crontab\".\n", $commandTester->getDisplay());

        $output = file_get_contents("crontab");
        $expected = <<<EOF
# foo: Lists /tmp
* * * * * ls -la /tmp

# bar: Lists home directory
0 10 * * * ls -la ~

EOF;
        $this->assertStringContainsString($expected, $output);
    }

    public function testExecuteWritesCrontabToFileGiven(): void
    {
        $commandTester = new CommandTester(self::$exportCommand);
        $commandTester->execute([
            "--config" => __DIR__ . "/../../config/chronis.example.yaml",
            "--output" => "/tmp/chronis_test_export"
        ]);

        $this->assertEquals("Crontab successfully exported to file \"/tmp/chronis_test_export\".\n", $commandTester->getDisplay());

        $output = file_get_contents("/tmp/chronis_test_export");
        $expected = <<<EOF
# foo: Lists /tmp
* * * * * ls -la /tmp

# bar: Lists home directory
0 10 * * * ls -la ~

EOF;
        $this->assertStringContainsString($expected, $output);
    }
}
