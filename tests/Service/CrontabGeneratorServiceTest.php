<?php

use BenTools\NaturalCronExpression\NaturalCronExpressionParser;
use PHPUnit\Framework\TestCase;
use Chronis\Model\CronJob;
use Chronis\Service\ConfigurationParserService;
use Chronis\Service\CrontabGeneratorService;
use Chronis\Service\ExpressionConverterService;

class CrontabGeneratorServiceTest extends TestCase
{
    private static $generator = null;

    public static function setUpBeforeClass(): void
    {
        $configurationParser = new ConfigurationParserService();
        $expressionConverter = new ExpressionConverterService(new NaturalCronExpressionParser());
        self::$generator = new CrontabGeneratorService($configurationParser, $expressionConverter);
    }

    public function testGeneratorReturnsCronJobs(): void
    {
        $jobs = self::$generator->generate(__DIR__ . "/../../config/chronis.example.yaml");

        $this->assertIsArray($jobs);
        $this->assertEquals(2, sizeof($jobs));

        $this->assertInstanceOf(CronJob::class, $jobs[0]);
        $job = (new CronJob())
            ->setCommand("ls -la /tmp")
            ->setDescription("Lists /tmp")
            ->setExpression("* * * * *")
            ->setName("foo");
        $this->assertEquals($job, $jobs[0]);

        $this->assertInstanceOf(CronJob::class, $jobs[1]);
        $job = (new CronJob())
            ->setCommand("ls -la ~")
            ->setDescription("Lists home directory")
            ->setExpression("0 10 * * *")
            ->setName("bar");
        $this->assertEquals($job, $jobs[1]);
    }
}
