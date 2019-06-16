<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Exception\ParseException;
use Chronis\Service\ConfigurationParserService;
use Chronis\Model\ConfigurationJob;

class ConfigurationParserServiceTest extends TestCase
{
    private static $parser = null;

    public static function setUpBeforeClass() : void
    {
        self::$parser = new ConfigurationParserService();
    }

    public function testParseThrowsExceptionWhenConfigurationFileNotFound() : void
    {
        $this->expectException(ParseException::class);

        self::$parser->parse("foo");
    }

    public function testParseReturnsConfigurationJobs() : void
    {
        $jobs = self::$parser->parse(__DIR__ . "/../../config/chronis.example.yaml");

        $this->assertIsArray($jobs);
        $this->assertEquals(2, sizeof($jobs));

        $this->assertInstanceOf(ConfigurationJob::class, $jobs[0]);
        $job = (new ConfigurationJob())
            ->setCommand("ls -la /tmp")
            ->setDescription("Lists /tmp")
            ->setExpression("Every minute")
            ->setName("foo")
            ->setType("cron");
        $this->assertEquals($job, $jobs[0]);

        $this->assertInstanceOf(ConfigurationJob::class, $jobs[1]);
        $job = (new ConfigurationJob())
            ->setCommand("ls -la ~")
            ->setDescription("Lists home directory")
            ->setExpression("Every day at 10 am")
            ->setName("bar")
            ->setType("cron");
        $this->assertEquals($job, $jobs[1]);
    }
}
