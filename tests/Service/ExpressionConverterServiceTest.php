<?php

use BenTools\NaturalCronExpression\NaturalCronExpressionParser;
use PHPUnit\Framework\TestCase;
use Chronis\Exception\ExpressionParseException;
use Chronis\Model\ConfigurationJob;
use Chronis\Model\CronJob;
use Chronis\Service\ExpressionConverterService;

class ExpressionConverterServiceTest extends TestCase
{
    private static $converter = null;

    public static function setUpBeforeClass() : void
    {
        self::$converter = new ExpressionConverterService(new NaturalCronExpressionParser());
    }

    public function testConvertThrowsExceptionWhenExpressionIsNull() : void
    {
        $job = (new ConfigurationJob())
            ->setCommand("ls -la /tmp")
            ->setDescription("Lists /tmp")
            ->setExpression(null)
            ->setName("foo")
            ->setType("cron");

        $this->expectException(ExpressionParseException::class);
        $this->expectExceptionMessage("Unable to parse expression \"\" of job named \"foo\".");

        self::$converter->convert($job);
    }

    public function testConvertReturnsCronJobWithConvertedExpressionWhenExpressionExists() : void
    {
        $job = (new ConfigurationJob())
            ->setCommand("ls -la /tmp")
            ->setDescription("Lists /tmp")
            ->setExpression("Every minute")
            ->setName("foo")
            ->setType("cron");

        $cronJob = self::$converter->convert($job);

        $this->assertInstanceOf(CronJob::class, $cronJob);
        $this->assertEquals("* * * * *", $cronJob->getExpression());
    }
}
